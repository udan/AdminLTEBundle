

do ($ = jQuery, Backbone = Backbone, Marionette = Backbone.Marionette, exports = window) ->
    
# -------------------------------------------------------------------------------------------- VIEWS
    
    RestorableRegion = Marionette.Region.extend
        _cache: null
        initialize: ->
            @_cache = @$el.html()
        onEmpty: ->
            @$el.html @_cache

    InfoModel = Backbone.Model.extend 
        defaults: 
            message: ''
            title  : ''

    InfoView = Marionette.ItemView.extend
        template  : '#message-view'
        className : 'alert alert-info'
        data      : {}
        initialize: (args = {}) ->
            @model = new InfoModel args
            @listenTo @model, 'change', @render

    DangerView = InfoView.extend
        className: 'alert alert-danger'

    WarningView = InfoView.extend
        className: 'alert alert-warning'

    SuccessView = InfoView.extend
        className: 'alert alert-success'

    LoadingView = InfoView.extend
        template: '#loading-view'

    SmallBoxModel = Backbone.Model.extend 
        defaults: 
            title     : ''
            message   : ''
            icon      : 'fa fa-exclamation-circle'
            linkText  : ''
            color     : 'aqua'

    SmallBoxView = Marionette.ItemView.extend
        template  : '#small-box-view'
        className : 'small-box'
        data      : {}
        ui        : 
            boxLink: '[data-action="box-link"]'
        events    : 
            'click [data-action="box-link"]' : 'detailClick'
        initialize: (args = {} ) ->
            @model = new SmallBoxModel args
            @listenTo @model, 'change', @render    
        onRender: ->
            @$el.attr 'class' : "small-box bg-#{@model.get('color')}"   
        colorize: (color) ->    
            @model.set 'color', color
            @
        detailClick: (event) ->
            event.preventDefault() 
            @trigger 'detail:click', @    
           
    BoxModel = Backbone.Model.extend 
        defaults: 
            title     : ''
            message   : ''
            icon      : 'fa fa-exclamation-circle'
            linkText  : ''
            color     : 'aqua'
            solid     : true
            tile      : false

    BoxToolsRegular = Marionette.ItemView.extend
        template: '#box-tools-regular'
        ui: 
            collapse: '[data-widget="collapse"]'
            remove  : '[data-widget="remove"]'

    BoxView = Marionette.LayoutView.extend
        model: BoxModel
        className : 'box'
        template: '#box-view'
        initialize: (args = {}) ->
            @model = new BoxModel args
            @listenTo @model, 'change', @render
        onRender: ->
            solid = (if @model.get('solid') then 'box-solid' else '')
            color = (if @model.get('color') then "box-#{@model.get('color')}" else 'box-default')
            tile  = (if @model.get('tile') then "bg-#{@model.get('color')}" else '')
            @$el.attr 'class', "box #{solid} #{color} #{tile}"
        regions: 
            tools  : '[data-role="box-tools"]'
            body   : '[data-role="body"]'

    BoxFooterView = BoxView.extend 
        template: '#box-footer-view'
        regions: 
            tools  : '[data-role="box-tools"]'
            body   : '[data-role="body"]'
            footer : '[data-role="footer"]'         

# --------------------------------------------------------------------------------- MAIN APPLICATION
    app = new Marionette.Application
    app.addRegions
        appTitle   : RestorableRegion.extend
            el: '#avanzu-admin-title'
            
        appNavbar  : RestorableRegion.extend
            el: '#avanzu-admin-navbar'
            
        appSidebar : RestorableRegion.extend
            el: '#avanzu-admin-sidebar'
            
        appHeader  : RestorableRegion.extend
            el: '#avanzu-admin-content-header'
            
        appContent : '#avanzu-admin-content'

# ------------------------------------------------------------------------------------------ EXPORTS
    exports.Avanzu ?=
        AdminInstance: app
        Views:
            MessageView     : InfoView
            InfoView        : InfoView
            WarningView     : WarningView
            DangerView      : DangerView
            LoadingView     : LoadingView
            SuccessView     : SuccessView
            SmallBoxView    : SmallBoxView
            BoxView         : BoxView
            BoxFooterView   : BoxFooterView
            BoxToolsRegular : BoxToolsRegular