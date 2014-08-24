do ($ = jQuery, exports = window) ->
    defaults =
        lines: 13 # The number of lines to draw
        length: 0 # The length of each line
        width: 15 # The line thickness
        radius: 28 # The radius of the inner circle
        corners: 1 # Corner roundness (0..1)
        rotate: 52 # The rotation offset
        direction: 1 # 1: clockwise, -1: counterclockwise
        color: "#000" # #rgb or #rrggbb or array of colors
        speed: 0.7 # Rounds per second
        trail: 44 # Afterglow percentage
        shadow: false # Whether to render a shadow
        hwaccel: false # Whether to use hardware acceleration
        className: "spinner" # The CSS class to assign to the spinner
        zIndex: 2e9 # The z-index (defaults to 2000000000)
        # top: "50%" # Top position relative to parent
        # left: "50%" # Left position relative to parent

    stopSpinner = (candidate) ->
        candidate.spinner.stop()
        delete candidate.spinner
        candidate

    $.fn.spin = (opts = {}) ->
        settings = $.extend true, {}, defaults, opts
        for spinner in @
            $spinner = $ spinner
            data = $spinner.data()
            stopSpinner data if data.spinner?
            data.spinner = new Spinner(settings).spin spinner
        @

    $
