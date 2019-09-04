<!-- TODO:ちゃんとjquery入れる -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    var activated_type_elem = e.target.nextElementSibling // activated
    var previous_type_elem = e.relatedTarget.nextElementSibling // previous
    activated_type_elem.disabled = false;
    previous_type_elem.disabled = true;
  });
})
</script>