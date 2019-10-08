$(function(){
var boolean = false;
$('#hideTabs').click(function(){
if(boolean)
{
$('.chord').removeClass('hidden');
$('#hideTabs').text('Skrýt akordy');
boolean = false;
}
else
{
$('.chord').addClass('hidden');
$('#hideTabs').text('Zobrazit akordy');
boolean = true;
}
});

$('#print').click(function(){
        var printWindow = window.open('', 'PRINT', 'height=400,width=600');
        var song = $('#song');
        printWindow.document.write('<!DOCTYPE html><html><head><link rel="stylesheet" type="text/css" href="/css/print.css" /></head><body>');
        printWindow.document.write(song.html()+'</body></html>');
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
        printWindow.close();
});

});
$('.shake').effect("shake");
