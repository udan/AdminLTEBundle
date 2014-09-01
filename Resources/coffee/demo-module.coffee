do ($ = jQuery, Backbone = Backbone, Marionette = Backbone.Marionette, exports = window) ->

    # ------------------------------------------------------------------------------------ SHORTCUTS
    Avanzu = exports.Avanzu
    App    = Avanzu.Admin

    DemoModel = Backbone.Model.extend
        urlRoot : ->
            App.conf.urls.demoModel
        defaults:
            name: 'some fancy name'    

    DemoForm = Avanzu.Views.FormView.extend
        template: '#demo-form'
        model   : DemoModel
        ui      :
            saveButton  : '[data-action="save"]'
            resetButton : '[data-action="reset"]'
        events  :
            'click [data-action="save"]' : 'saveClick'
            'click [data-action="reset"]': 'resetClick'
        saveClick: (evt) ->
            evt.preventDefault()
            console.log evt
            @populateModel()
            @model.save()


    Controller = Marionette.Controller.extend
        initialize: (args = {}) ->
            @region = args.region
        run : ->
            model = new DemoModel gender: 'f'
            form  = new DemoForm model: model

            @region.show form



    # ----------------------------------------------------------------------------------- THE MODULE

    DemoModule = Marionette.Module.extend
        onStart: (options = {}) ->

            @region     = App.appContent
            @controller = new Controller region: @region
            @controller.run()

    App.module "Demo", DemoModule
