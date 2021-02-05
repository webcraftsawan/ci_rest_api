
    <div class="footer">
        <div class="footer-inner">
            <div class="footer-content">
                <span class="bigger-120">
                    <span class="blue bolder">Indore Talk</span> Application &copy; 2020-21
                </span>
            </div>
        </div>
    </div>
    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
</div>
    <!-- /.main-container -->

    <!-- basic scripts -->

    <!--[if !IE]> -->
    <script src="<?= base_url("assets/js/jquery-2.1.4.min.js") ?>"></script>

    <!-- include summernote css/js -->
    <link href="//cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <!-- Datetime picker -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" />
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />

    
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'Hello Bootstrap 4',
                tabsize: 2,
                height: 250
            });

            $('.datetimepicker').datetimepicker({
                format:'YYYY-MM-DD h:mm A'
            });

            $(".select2-multiple").select2( {
                theme: "bootstrap",
                placeholder: "Nothing Selected",
            });

        });
    </script>
    
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            <?php
                $session = \Config\Services::session();
            if ($session->getFlashdata('success')) :
                ?>  
                toastr["success"]("<strong>Success!</strong> <?= $session->getFlashdata('success') ?>!");
                <?php
            endif;
            ?>

            <?php
                $session = \Config\Services::session();
            if ($session->getFlashdata('error')) :
                ?>  
                toastr["error"]("<?= $session->getFlashdata('error') ?>!");
                <?php
            endif;
            ?>

            <?php
                $session = \Config\Services::session();
            if ($session->getFlashdata('warning')) :
                ?>  
                toastr["warning"]("<?= $session->getFlashdata('warning') ?>!");
                <?php
            endif;
            ?>

        });
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>

    <!-- <![endif]-->

    <!--[if IE]>
<script src="<?= base_url() ?>/assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
    <script type="text/javascript">
        if ('ontouchstart' in document.documentElement) document.write(
            "<script src='<?= base_url("assets/js/jquery.mobile.custom.min.js") ?>'>" + "<" + "/script>");
    </script>
    <script src="<?= base_url("assets/js/bootstrap.min.js") ?>"></script>

    <!-- page specific plugin scripts -->

    <!--[if lte IE 8]>
          <script src="<?= base_url() ?>/assets/js/excanvas.min.js"></script>
        <![endif]-->
    <script src="<?= base_url("assets/js/jquery-ui.custom.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/jquery.ui.touch-punch.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/jquery.easypiechart.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/jquery.sparkline.index.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/jquery.flot.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/jquery.flot.pie.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/jquery.flot.resize.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/bootstrap-datepicker.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/bootstrap-timepicker.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/moment.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/daterangepicker.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/bootstrap-datetimepicker.min.js") ?>"></script>

    <script src="<?= base_url("assets/js/bootstrap-tag.min.js") ?>"></script>

    <!-- ace scripts -->
    <script src="<?= base_url("assets/js/ace-elements.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/ace.min.js") ?>"></script>

    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        jQuery(function($) {



            $('.easy-pie-chart.percentage').each(function() {
                var $box = $(this).closest('.infobox');
                var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css(
                    'color') : 'rgba(255,255,255,0.95)');
                var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' :
                    '#E2E2E2';
                var size = parseInt($(this).data('size')) || 50;
                $(this).easyPieChart({
                    barColor: barColor,
                    trackColor: trackColor,
                    scaleColor: false,
                    lineCap: 'butt',
                    lineWidth: parseInt(size / 10),
                    animate: ace.vars['old_ie'] ? false : 1000,
                    size: size
                });
            })

            $('.sparkline').each(function() {
                var $box = $(this).closest('.infobox');
                var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
                $(this).sparkline('html', {
                    tagValuesAttribute: 'data-values',
                    type: 'bar',
                    barColor: barColor,
                    chartRangeMin: $(this).data('min') || 0
                });
            });


            //flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
            //but sometimes it brings up errors with normal resize event handlers
            $.resize.throttleWindow = false;

            var placeholder = $('#piechart-placeholder').css({
                'width': '90%',
                'min-height': '150px'
            });
            var data = [{
                label: "social networks",
                data: 38.7,
                color: "#68BC31"
            }, {
                label: "search engines",
                data: 24.5,
                color: "#2091CF"
            }, {
                label: "ad campaigns",
                data: 8.2,
                color: "#AF4E96"
            }, {
                label: "direct traffic",
                data: 18.6,
                color: "#DA5430"
            }, {
                label: "other",
                data: 10,
                color: "#FEE074"
            }]

            function drawPieChart(placeholder, data, position) {
                $.plot(placeholder, data, {
                    series: {
                        pie: {
                            show: true,
                            tilt: 0.8,
                            highlight: {
                                opacity: 0.25
                            },
                            stroke: {
                                color: '#fff',
                                width: 2
                            },
                            startAngle: 2
                        }
                    },
                    legend: {
                        show: true,
                        position: position || "ne",
                        labelBoxBorderColor: null,
                        margin: [-30, 15]
                    },
                    grid: {
                        hoverable: true,
                        clickable: true
                    }
                })
            }
            // drawPieChart(placeholder, data);

            /**
            we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
            so that's not needed actually.
            */
            // placeholder.data('chart', data);
            // placeholder.data('draw', drawPieChart);


            //pie chart tooltip example
            var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide()
                .appendTo('body');
            var previousPoint = null;

            placeholder.on('plothover', function(event, pos, item) {
                if (item) {
                    if (previousPoint != item.seriesIndex) {
                        previousPoint = item.seriesIndex;
                        var tip = item.series['label'] + " : " + item.series['percent'] + '%';
                        $tooltip.show().children(0).text(tip);
                    }
                    $tooltip.css({
                        top: pos.pageY + 10,
                        left: pos.pageX + 10
                    });
                } else {
                    $tooltip.hide();
                    previousPoint = null;
                }

            });

            /////////////////////////////////////
            $(document).one('ajaxloadstart.page', function(e) {
                $tooltip.remove();
            });

            var d1 = [];
            for (var i = 0; i < Math.PI * 2; i += 0.5) {
                d1.push([i, Math.sin(i)]);
            }

            var d2 = [];
            for (var i = 0; i < Math.PI * 2; i += 0.5) {
                d2.push([i, Math.cos(i)]);
            }

            var d3 = [];
            for (var i = 0; i < Math.PI * 2; i += 0.2) {
                d3.push([i, Math.tan(i)]);
            }


            /*var sales_charts = $('#sales-charts').css({
                'width': '100%',
                'height': '220px'
            });
            $.plot("#sales-charts", [{
                label: "Domains",
                data: d1
            }, {
                label: "Hosting",
                data: d2
            }, {
                label: "Services",
                data: d3
            }], {
                hoverable: true,
                shadowSize: 0,
                series: {
                    lines: {
                        show: true
                    },
                    points: {
                        show: true
                    }
                },
                xaxis: {
                    tickLength: 0
                },
                yaxis: {
                    ticks: 10,
                    min: -2,
                    max: 2,
                    tickDecimals: 3
                },
                grid: {
                    backgroundColor: {
                        colors: ["#fff", "#fff"]
                    },
                    borderWidth: 1,
                    borderColor: '#555'
                }
            });*/


            $('#recent-box [data-rel="tooltip"]').tooltip({
                placement: tooltip_placement
            });

            function tooltip_placement(context, source) {
                var $source = $(source);
                var $parent = $source.closest('.tab-content')
                var off1 = $parent.offset();
                var w1 = $parent.width();

                var off2 = $source.offset();
                //var w2 = $source.width();

                if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2)) return 'right';
                return 'left';
            }


            $('.dialogs,.comments').ace_scroll({
                size: 300
            });


            //Android's default browser somehow is confused when tapping on label which will lead to dragging the task
            //so disable dragging when clicking on label
            var agent = navigator.userAgent.toLowerCase();
            if (ace.vars['touch'] && ace.vars['android']) {
                $('#tasks').on('touchstart', function(e) {
                    var li = $(e.target).closest('#tasks li');
                    if (li.length == 0) return;
                    var label = li.find('label.inline').get(0);
                    if (label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation();
                });
            }

            $('#tasks').sortable({
                opacity: 0.8,
                revert: true,
                forceHelperSize: true,
                placeholder: 'draggable-placeholder',
                forcePlaceholderSize: true,
                tolerance: 'pointer',
                stop: function(event, ui) {
                    //just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
                    $(ui.item).css('z-index', 'auto');
                }
            });
            $('#tasks').disableSelection();
            $('#tasks input:checkbox').removeAttr('checked').on('click', function() {
                if (this.checked) $(this).closest('li').addClass('selected');
                else $(this).closest('li').removeClass('selected');
            });


            //show the dropdowns on top or bottom depending on window height and menu position
            $('#task-tab .dropdown-hover').on('mouseenter', function(e) {
                var offset = $(this).offset();

                var $w = $(window)
                if (offset.top > $w.scrollTop() + $w.innerHeight() - 100)
                    $(this).addClass('dropup');
                else $(this).removeClass('dropup');
            });

        })

                $('#timepicker1').timepicker({
                    minuteStep: 1,
                    showSeconds: true,
                    showMeridian: false,
                    disableFocus: true,
                    icons: {
                        up: 'fa fa-chevron-up',
                        down: 'fa fa-chevron-down'
                    }
                }).on('focus', function() {
                    $('#timepicker1').timepicker('showWidget');
                }).next().on(ace.click_event, function(){
                    $(this).prev().focus();
                });

                if(!ace.vars['old_ie']) $('#date-timepicker1').datetimepicker({
                 //format: 'MM/DD/YYYY h:mm:ss A',//use this option to display seconds
                 icons: {
                    time: 'fa fa-clock-o',
                    date: 'fa fa-calendar',
                    up: 'fa fa-chevron-up',
                    down: 'fa fa-chevron-down',
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-arrows ',
                    clear: 'fa fa-trash',
                    close: 'fa fa-times'
                 }
                }).next().on(ace.click_event, function(){
                    $(this).prev().focus();
                });

                //tag input 1
                var tag_input = $('#form-field-tags');
                try{
                    tag_input.tag(
                      {
                        placeholder:tag_input.attr('placeholder'),
                        //enable typeahead by specifying the source array
                        source: ace.vars['US_STATES'],//defined in ace.js >> ace.enable_search_ahead
                        /**
                        //or fetch data from database, fetch those that match "query"
                        source: function(query, process) {
                          $.ajax({url: 'remote_source.php?q='+encodeURIComponent(query)})
                          .done(function(result_items){
                            process(result_items);
                          });
                        }
                        */
                      }
                    )
            
                    //programmatically add/remove a tag
                    var $tag_obj = $('#form-field-tags').data('tag');
                    // $tag_obj.add('Programmatically Added');
                    
                    var index = $tag_obj.inValues('some tag');
                    $tag_obj.remove(index);
                }
                catch(e) {
                    //display a textarea for old IE, because it doesn't support this plugin or another one I tried!
                    tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
                    //autosize($('#form-field-tags'));
                }

                // tag input 2
                var tag_input = $('#form-field-tags2');
                try{
                    tag_input.tag(
                      {
                        placeholder:tag_input.attr('placeholder'),
                        //enable typeahead by specifying the source array
                        source: ace.vars['US_STATES'],//defined in ace.js >> ace.enable_search_ahead
                        /**
                        //or fetch data from database, fetch those that match "query"
                        source: function(query, process) {
                          $.ajax({url: 'remote_source.php?q='+encodeURIComponent(query)})
                          .done(function(result_items){
                            process(result_items);
                          });
                        }
                        */
                      }
                    )
            
                    //programmatically add/remove a tag
                    var $tag_obj = $('#form-field-tags2').data('tag');
                    // $tag_obj.add('Programmatically Added');
                    
                    var index = $tag_obj.inValues('some tag');
                    $tag_obj.remove(index);
                }catch(e) {
                    //display a textarea for old IE, because it doesn't support this plugin or another one I tried!
                    tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
                    //autosize($('#form-field-tags2'));
                }

                /*Browse video*/
                $('#id-input-file-3').ace_file_input({
                    style: 'well',
                    btn_choose: 'Drop files here or click to choose',
                    btn_change: null,
                    no_icon: 'ace-icon fa fa-cloud-upload',
                    droppable: true,
                    thumbnail: 'small'//large | fit
                    //,icon_remove:null//set null, to hide remove/reset button
                    ,before_change:function(files, dropped) {
                        return true;
                    }
                    ,before_remove : function() {
                        return true;
                    },
                    preview_error : function(filename, error_code) {
                        //name of the file that failed
                        //error_code values
                        //1 = 'FILE_LOAD_FAILED',
                        //2 = 'IMAGE_LOAD_FAILED',
                        //3 = 'THUMBNAIL_FAILED'
                        //alert(error_code);
                    }
            
                }).on('change', function(){
                    console.log($(this).data('ace_input_files'));
                    console.log($(this).data('ace_input_method'));
                });
                /*Browse video*/

                /*Upload video cover image*/
                $('#id-input-file-4').ace_file_input({
                    style: 'well',
                    btn_choose: 'Drop files here or click to choose',
                    btn_change: null,
                    no_icon: 'ace-icon fa fa-cloud-upload',
                    droppable: true,
                    thumbnail: 'small' //small | large | fit | icon_remove : null // set null, to hide remove/reset button
                    ,before_change:function(files, dropped) {
                        //Check an example below
                        //or examples/file-upload.html
                        return true;
                    }
                    ,before_remove : function() {
                        console.log('remove here');
                        return true;
                    }
                    ,
                    preview_error : function(filename, error_code) {
                        //name of the file that failed
                        //error_code values
                        //1 = 'FILE_LOAD_FAILED',
                        //2 = 'IMAGE_LOAD_FAILED',
                        //3 = 'THUMBNAIL_FAILED'
                        //alert(error_code);
                    }
            
                }).on('change', function(){
                    console.log($(this).data('ace_input_files'));
                    console.log($(this).data('ace_input_method'));
                    if($('label.ace-file-multiple').hasClass('ace-file-multiple23')){
                        $("label.ace-file-multiple23").remove();
                    }
                    console.log('Here is me');
                });
                /*Upload video cover image*/

                $('#id-input-file-5').ace_file_input({
                    style: 'well',
                    btn_choose: 'Drop files here or click to choose',
                    btn_change: null,
                    no_icon: 'ace-icon fa fa-cloud-upload',
                    droppable: true,
                    thumbnail: 'small' //small | large | fit | icon_remove : null // set null, to hide remove/reset button
                    ,before_change:function(files, dropped) {
                        //Check an example below
                        //or examples/file-upload.html
                        return true;
                    }
                    ,before_remove : function() {
                        console.log('remove here');
                        return true;
                    }
                    ,
                    preview_error : function(filename, error_code) {
                        //name of the file that failed
                        //error_code values
                        //1 = 'FILE_LOAD_FAILED',
                        //2 = 'IMAGE_LOAD_FAILED',
                        //3 = 'THUMBNAIL_FAILED'
                        //alert(error_code);
                    }
            
                }).on('change', function(){
                    console.log($(this).data('ace_input_files'));
                    console.log($(this).data('ace_input_method'));
                    console.log('Here is me');
                });

                // Input Tags Jquery
                var tag_input = $('.form-field-tags');
                try{
                    tag_input.tag(
                      {
                        placeholder:tag_input.attr('placeholder'),
                        // enable typeahead by specifying the source array
                        source: ace.vars['US_STATES'], // defined in ace.js >> ace.enable_search_ahead
                        // or fetch data from database, fetch those that match "query"
                        source: function(query, process) {
                          $.ajax({url: 'remote_source.php?q='+encodeURIComponent(query)})
                          .done(function(result_items){
                            process(result_items);
                          });
                        }
                      }
                    )
                    // programmatically add/remove a tag
                    var $tag_obj = $('.form-field-tags').data('tag');                    
                    var index = $tag_obj.inValues('some tag');
                    $tag_obj.remove(index);
                }catch(e) {
                    // display a textarea for old IE, because it doesn't support this plugin or another one I tried!
                    tag_input.after('<textarea id="'+tag_input.attr('id')+'" class="form-control" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
                    // autosize($('.form-field-tags'));
                }

                // Date Time Picker Jquery
                if(!ace.vars['old_ie']) $('.date-timepicker').datetimepicker({
                 format: 'DD-MM-YYYY h:mm A',//use this option to display seconds
                 icons: {
                    time: 'fa fa-clock-o',
                    date: 'fa fa-calendar',
                    up: 'fa fa-chevron-up',
                    down: 'fa fa-chevron-down',
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-arrows ',
                    clear: 'fa fa-trash',
                    close: 'fa fa-times'
                 }
                }).next().on(ace.click_event, function(){
                    $(this).prev().focus();
                });

                // Time Picker Jquery
                if(!ace.vars['old_ie']) $('.timepicker').datetimepicker({
                 format: 'h:mm A',//use this option to display seconds
                 icons: {
                    time: 'fa fa-clock-o',
                    date: 'fa fa-calendar',
                    up: 'fa fa-chevron-up',
                    down: 'fa fa-chevron-down',
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-arrows ',
                    clear: 'fa fa-trash',
                    close: 'fa fa-times'
                 }
                }).next().on(ace.click_event, function(){
                    $(this).prev().focus();
                });

                // Ace Input field for drop image
                $('.id-input-file').ace_file_input({
                    style: 'well',
                    btn_choose: 'Drop files here or click to choose',
                    btn_change: null,
                    no_icon: 'ace-icon fa fa-cloud-upload',
                    droppable: true,
                    thumbnail: 'small' //small | large | fit | icon_remove : null // set null, to hide remove/reset button
                    ,before_change:function(files, dropped) {
                        //Check an example below
                        //or examples/file-upload.html
                        return true;
                    }
                    ,before_remove : function() {
                        console.log('remove here');
                        return true;
                    }
                    ,
                    preview_error : function(filename, error_code) {
                        //name of the file that failed
                        //error_code values
                        //1 = 'FILE_LOAD_FAILED',
                        //2 = 'IMAGE_LOAD_FAILED',
                        //3 = 'THUMBNAIL_FAILED'
                        //alert(error_code);
                    }
            
                }).on('change', function(){
                    console.log($(this).data('ace_input_files'));
                    console.log($(this).data('ace_input_method'));
                    console.log('Here is me');
                });

                $(document).on('change', "select[name=category_id]" , function(){
                    var id = $("select[name=category_id] option:selected").val();
                    $('select[name=subcategory_id]').html($('<option>').text("Select").attr('value', ""));
                    $.ajax({
                        type: "GET",
                        url: "<?= base_url('admin/category/subcategories') ?>/"+id,
                        dataType: "json",
                        success: function (response) {
                            if(response.status == true){
                                $.each(response.subcategories, function(i, value) {
                                    $('select[name=subcategory_id]').append($('<option>').text(value.title).attr('value', value.id));
                                });
                            }
                        }
                    });
                });
                /***************/
                $('.show-details-btn').on('click', function(e) {
                    e.preventDefault();
                    $(this).closest('tr').next().toggleClass('open');
                    $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
                });
                /***************/
    </script>
</body>

</html>
