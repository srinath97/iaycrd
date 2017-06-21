$(document).ready(function(){
    
    $('#element_5').on('input propertychange paste', function()
    {
        $x=$('#element_5').val();
        $y=$('#element_6').val();
        $('#element_7').val($x-$y);
    });
    $('#element_6').on('input propertychange paste', function()
    {
        $x=$('#element_5').val();
        $y=$('#element_6').val();
        $('#element_7').val($x-$y);
    });

});
