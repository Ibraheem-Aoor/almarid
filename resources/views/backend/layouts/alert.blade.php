<div id="alert-message" class="alert alert-fixed  alert-info" role="alert">
    <div class="container">
        <div class="row">
            <button type="button" class="close close-fixed">
                <span class="fa fa-times"></span>
            </button>
            <p class="alert-message-body">
                <strong></strong>
                <span></span>
            </p>
        </div>
    </div>
</div>

<style>
    /*.alert-success {
        background: none;
        filter: none;
        border: 0;
        background-color: rgba( 104, 159, 56 , .9 );
    }*/
    .alert-success {
        background: none;
        filter: none;
        border: 0;
        background-color: rgba( 58, 149, 207 , .9 );
    }
    .alert-warning {
        background: none;
        filter: none;
        border: 0;
        background-color: rgba( 223, 170, 99 , .9 );
    }
    .alert-danger {
        background: none;
        filter: none;
        border: 0;
        background-color: rgba( 219, 68, 55 , .9 );
    }
    .alert {
        text-shadow:none;
        -webkit-box-shadow: none;
        box-shadow: none;
        padding: 15px;
        border-radius: 0px;
        border: 0;
        color: #fff;
        margin-bottom: 0;
        display: none;
    }
    .alert-fixed{
        width: 100%;
        overflow: hidden;
        top: 0;
        left: 0;
        z-index: 2147483647;
        position: fixed;
        -webkit-transition: height 0.3s;
        -moz-transition: height 0.3s;
        -ms-transition: height 0.3s;
        -o-transition: height 0.3s;
        transition: height 0.3s;
    }
    .alert-fixed.smaller {
        width: 100%;
        overflow: hidden;
        position: fixed;
    }
    .alert .close-fixed {
        font-size: 14px;
        line-height: 1;
        color: #fff;
        text-shadow:none;
        opacity: 0.9;
        filter: alpha(opacity=90);
        padding-top: 2px;
    }
    .alert .close-fixed:hover
    {
        color: #000;
    }
    .alert-message-body{
        text-align: center;
        /*margin-right:40%;*/
        /*margin-left:40%;*/
    }
</style>

<script>
    function showAlertMessage(messageType, strongText, messageBody, callback, timeOut){
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        timeOut = typeof timeOut !== 'undefined' ? timeOut : 5000;
        if( $.hasData('#alert-message', 'timeout') ){
            clearTimeout($('#alert-message').data('timeout'));
        }
        $('.alert-message-body strong').html(strongText);
        $('.alert-message-body span').html(messageBody);
        $('#alert-message')
                .hide()
                .removeClass('alert-success alert-info alert-warning alert-danger')
                .addClass(messageType)
                .fadeIn();
        var timeout = setTimeout(function(){
            $('#alert-message').fadeOut('slow', function(){
                if(callback !== undefined){
                    callback();
                }
            });
        }, timeOut);
        $('#alert-message').data('timeout', timeout);
    }
</script>
