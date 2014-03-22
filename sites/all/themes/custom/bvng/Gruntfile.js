module.exports = function(grunt) {
    'use strict';
 
    require('matchdep').filterDev('grunt-!(cli)').forEach(grunt.loadNpmTasks);
 
    grunt.initConfig({
        less: {
            dev: {
                options: {
                    sourceMap: true,
                    sourceMapFilename: 'css/style.map'
                },
                files: {
                    'css/style.css': 'less/style.less'
                }
            }
        },
        watch: {
            all: {
                files: ['less/**/*.less'],
                tasks: ['less'],
            }
        }
    });
 
    grunt.registerTask('default', ['less', 'watch']);
};