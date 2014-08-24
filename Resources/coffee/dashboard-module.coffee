
do ($ = jQuery, Backbone = Backbone, Marionette = Backbone.Marionette, exports = window) ->

    # ------------------------------------------------------------------------------------ SHORTCUTS 
    Avanzu = exports.Avanzu
    App    = Avanzu.AdminInstance



    # ----------------------------------------------------------------------------------- THE MODULE
    DashboardModule = Marionette.Module.extend
        onStart: ->
            console?.log 'DashboardModule starting'
        onStop: ->
            console?.log 'DashboardModule stopping'


    App.module('Dashboard', DashboardModule);

