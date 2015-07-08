'use strict';
module.exports = function(grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        concat: { 
          dist: {

              src: [
                  'assets/js/plugins/*.js', // All JS in the libs folder
              ],
              
              dest: 'assets/js/plugins-min.js',
          }
        },
        uglify: {

          build: {
            src: ['assets/js/plugins/*.js'],
            dest: 'assets/js/plugins-min.js'
          }
        },
        less: {
            all: {
                files: {
                    'style.css' : 'assets/less/sosimple.less'
                }
            }
        },
        autoprefixer: {
            options: {
                browsers: ['last 2 version', 'ie 8', 'ie 9']
            },
            no_dest: {
                src: 'style.css'
            },
        },
        watch: {
            js: {
                files: ['assets/js/plugins/*.js'],
                tasks: ['uglify']
            },
            less: {
                files: [
                    'assets/less/*.less'
                ],
                tasks: ['less', 'autoprefixer'],
                options: {
                    spawn: false,
                    livereload: false
                }
            }
        }
    });

    // Load tasks
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-autoprefixer');

    // Register tasks
    grunt.registerTask('default', ['concat', 'uglify', 'less', 'autoprefixer']);

    grunt.registerTask('dev', [
        'watch'
    ]);

};