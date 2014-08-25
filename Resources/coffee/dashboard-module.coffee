
do ($ = jQuery, Backbone = Backbone, Marionette = Backbone.Marionette, exports = window) ->

    # ------------------------------------------------------------------------------------ SHORTCUTS
    Avanzu = exports.Avanzu
    App    = Avanzu.Admin

    # ----------------------------------------------------------------------------------- THE MODELS

    WidgetModel = Avanzu.Models.BoxModel.extend
        getView: ->
            @defaultView

    BoxWidgetModel = WidgetModel.extend
        initialize: ->
            @defaultView = BoxWidget
            WidgetModel.prototype.initialize.call @

    SmallWidgetModel = WidgetModel.extend
        initialize: ->
            @defaultView = SmallBoxWidget
            WidgetModel.prototype.initialize.call @

    WidgetCollection = Backbone.Collection.extend
        initialize: (args) ->


    # ------------------------------------------------------------------------------------ THE VIEWS
    BoxWidget = Avanzu.Views.BoxView.extend
        className: 'col-sm-4'
        initialize: (args) ->

    SmallBoxWidget = Avanzu.Views.SmallBoxView.extend
        className: 'col-sm-4'
        initialize: (args) ->


    WidgetList = Marionette.CollectionView.extend
        className: 'row'
        getChildView: (item) ->
            item.defaultView ? BoxWidget


    # ------------------------------------------------------------------------------- THE CONTROLLER

    Controller = Marionette.Controller.extend

        initialize: (@module) ->
            collection = new Backbone.Collection

            for i in [1..20]
                cls   = (if (i % 2) is 0 then SmallWidgetModel else BoxWidgetModel)
                model = new cls
                    solid: ((i % 2) is 0)
                    color: 'maroon'
                    title: "some title #{i}"
                    message: "some message... #{i}"
                    tile: ((i % 2) is 0)
                collection.add model

            @list = new WidgetList
                collection: collection


        execute: ->
            @module.region.show @list



    # ----------------------------------------------------------------------------------- THE MODULE
    DashboardModule = Marionette.Module.extend
        onStart: ->
            @region = App.appContent
            controller = new Controller @
            controller.execute()
        onStop: ->
            console?.log 'DashboardModule stopping'


    App.module('Dashboard', DashboardModule);
