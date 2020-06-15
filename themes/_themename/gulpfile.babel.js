import gulp from 'gulp'
//yargs allows us to add arguments in command line and use arguments in the gulp file
import yargs from 'yargs'
//gulp itself is just a task runner, we need gulp-sass to actually compile scss to css
import sass from 'gulp-sass'
//cleanCSS minifies the css  
import cleanCSS from './src/node_modules/gulp-clean-css'
//gulp if allows if statements in the pipe functions
import gulpif from 'gulp-if'
//make css sourcemaps if we're in development mode
import sourcemaps from 'gulp-sourcemaps'
//minify any images
import imagemin from 'gulp-imagemin'
//delete dist folder before we build
import del from './src/node_modules/del'
//webpack-gulp integration
import webpack from 'webpack-stream'
//allows us to wire webpack up to three separate js files and give us three output files (admin/login/bundle)
import named from './src/node_modules/vinyl-named'
//browsersync creates a mini server so we can live reload and set MAMP as a proxy
import browserSync from 'browser-sync'
//zip up a folder
import zip from 'gulp-zip'
//use this to change _themename to our projects name from package.json
import gulpreplace from 'gulp-replace'
//so we can import& use the name of our project:
import info from './package.json'


//browsersync creates a mini server
const server = browserSync.create();

//set production flag to true when we have --prod argument 'gulp --prod'
const PRODUCTION = yargs.argv.prod;

//this paths object make sure we dont have paths all over the place below
const paths = {
    styles: {
        src: ['src/assets/scss/bundle.scss', 'src/assets/scss/admin.scss', 'src/assets/scss/login.scss'],
        dest: 'dist/assets/css'
    },
    images: {
        src: 'src/assets/images/**/*.{jpg,jpeg,png,svg,gif}',
        dest: 'dist/assets/images'
    },
    scripts: {
        src: ['src/assets/js/bundle.js', 'src/assets/js/admin.js', 'src/assets/js/login.js', 'src/assets/js/customize-preview.js'],
        dest: 'dist/assets/js'
    },
    other: {
        src: ['src/assets/**/*', '!src/assets/{images,js,scss}', '!src/assets/{images,js,scss}/**/*'],
        dest: 'dist/assets'
    },
    plugins: {
        src: [
          "../../plugins/_themename-metaboxes/packaged/*"
        ],
        dest: ["lib/plugins"]
      },
    package: {
        //the files we are zipping when exporting into 'final' zip file
        src: ['**/*', '!.vscode', '!node_modules{,/**}', '!final{,/**}', '!src{,/**}', '!.babelrc', '!.gitignore', '!gulpfile.babel.js', '!package.json', '!package-lock.json'],
        dest: 'final'

    }
}

//gulp task to initialise the server and uses the MAMP server as a proxy, get the name from npm package
export const serve = (done) => {
    server.init({
        proxy: `http://localhost:8888/${info.name}/`
    });
    //let gulp know we've done our task
    done();
}

//gulp task to reload the server
export const reload = (done) => {
    server.reload();
    done();
}

//gulp task to delete dist folder
export const clean = () => del(['dist']);

//gulp task to compile styles
export const styles = () => {
    return gulp.src(paths.styles.src)
        .pipe(gulpif(!PRODUCTION, sourcemaps.init()))
        .pipe(sass().on('error', sass.logError))
        .pipe(gulpif(PRODUCTION, cleanCSS({ compatibility: 'ie8' })))
        .pipe(gulpif(!PRODUCTION, sourcemaps.write()))
        .pipe(gulp.dest(paths.styles.dest))
        //this injects the css into the browser without even refreshing the page (cool browsersync feature)
        .pipe(server.stream());
}

//gulp task to minify images
export const images = () => {
    return gulp.src(paths.images.src)
        .pipe(gulpif(PRODUCTION, imagemin()))
        .pipe(gulp.dest(paths.images.dest));
}

//gulp task to move our files to dist folder
export const copy = () => {
    return gulp
        .src(paths.other.src)
        .pipe(gulp.dest(paths.other.dest));
}

export const copyPlugins = () => {
    return gulp
        .src(paths.plugins.src)
        .pipe(gulp.dest(paths.plugins.dest));
  };
  

//gulp task to watch for changes
export const watch = () => {
    //dont need to reload scss as we are using the cool server.stream() feature above
    gulp.watch('src/assets/scss/**/*.scss', styles);
    gulp.watch('src/assets/**/*.js', gulp.series(scripts, reload));
    //all php files in root/subfolders
    gulp.watch('**/*.php', reload);
    gulp.watch(paths.images.src, gulp.series(images, reload));
    gulp.watch(paths.other.src, gulp.series(copy, reload));
}

//gulp task to compile our js
export const scripts = () => {
    //array of our multiple js entry points
    return gulp.src(paths.scripts.src)
        //run the vinyl-named plugin
        .pipe(named())
        //run webpack for our three separate js entry points
        .pipe(webpack({
            module: {
                rules: [
                    {
                        test: /\.js$/,
                        use: {
                            loader: 'babel-loader',
                            options: {
                                presets: ['@babel/preset-env']
                            }
                        }
                    }
                ]
            },
            output: {
                //using vinyl-named here to allow multiple outputs
                filename: '[name].js'
            },
            externals: {
                jquery: 'jQuery'
            },
            devtool: !PRODUCTION ? 'inline-source-map' : false,
            mode: PRODUCTION ? 'production' : 'development'
        }))
        .pipe(gulp.dest(paths.scripts.dest));
}



// //GIT AUTO PUSH
// var git = require('gulp-git');
// //gulp task to minify images
// export const add = () => {
//     console.log('------------adding------------');
//     return gulp.src('./*')
//         .pipe(git.add({quiet: true}));
// }
// //gulp task to minify images
// export const commit = () => {
//     console.log('------------commiting------------');
//     return gulp.src('./*')
//         .pipe(git.commit('auto commit', {quiet: true}));
// }
//gulp task to minify images
// export const push = (done) => {
//     console.log('------------pushing------------');
//     git.push('origin', 'master', function (err) {
//         if (err) throw err;
//         done();
//     });
//     done();
// }


//\\ DEV BUILD SCRIPTS //\\

//use when developing (also npm start)
export const dev = gulp.series(
    clean,
    //run async
    gulp.parallel(styles, scripts, images, copy),
    serve,
    watch
    //gulp.parallel(add, commit)
);
//set 'gulp dev' to default 'gulp' command (it has also been set to 'npm start')
export default dev;



//\\ FINAL BUILD SCRIPTS //\\

//build into dist folder (use --prod flag to minimise etc.)
export const build = gulp.series(
    clean,
    gulp.parallel(styles, scripts, images, copy),
    copyPlugins
);
//zip up assets into final folder
export const compress = () => {
    return gulp
        .src(paths.package.src)
        //dont replace zip file names (it corrupts them for some reason)
        //gulpif resolves truthy/falsy values.. and can have a function inside, also it gets passed the file object.
        .pipe(
            gulpif(
              file => file.relative.split(".").pop() !== "zip",
              gulpreplace("_themename", info.name)
            )
          )
        
        .pipe(zip(`${info.name}.zip`))
        .pipe(gulp.dest(paths.package.dest));
}
//bundle theme into zip folder when theme finished
export const final = gulp.series(build, compress);

