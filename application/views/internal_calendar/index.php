<div id="page-content-wrapper">
    <div class="container-fluid">
        <?php if($level == 1) : ?>
            <?php echo $calendar; ?>
            <script type="text/javascript">
                $(document).ready(function(){
                    $(".calendar .days .day").click(function(){
                        day_num = $(this).find(".day_num").html();
                        day_data = prompt("Enter Meeting",$(this).find(".content").html());
                        if(day_data != null){
                            $.ajax({
                                url: window.location,
                                type: "POST",
                                data: {
                                    day: day_num,
                                    data: day_data
                                },
                                success: function(msg){
                                    location.reload();
                                }    
                            });
                        }
                    });
                });
            </script>
        <?php else : ?>
            <?php echo $calendar; ?>
        <?php endif; ?>
    </div>
</div>
