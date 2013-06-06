/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function addRow(name){

    var $newRow = $('#' + name + 'TemplateRow').clone(true);
    var lastIndex =  $('#' + name + 'Row tr:last :input').attr("name");
   
    var re = new RegExp("([0-9]+)", "g");
    var match = lastIndex.match(re)[0];
    var intmatch = parseInt(match) + 1;
    $newRow.find('*').andSelf().removeAttr('id');
    $newRow.find(":input").each(function(){
        $(this).attr("name",function(i,v){
               return v.replace(re, intmatch );
        }).val("");
    });
    var button = $("<button type=\"button\" id=\"DeleteBoxRow\" name=\"DeleteBoxRow\" value=\"-\" >-</button>");
    //$newRow.append(button);
    $newRow.find('button').replaceWith( button );
     $('#' + name +'Row tr:last').after($newRow);
    

 // alert($("#Doc_creator_0_creatorName_@value").val());
}

$(function() {
    $('.calendar').live('click', function() {
             $(this).datepicker('destroy').datepicker({dateFormat: 'yy-mm-dd', showOn:'focus'}).focus();
        });

    
    $('#DeleteBoxRow').live("click", function() {
      
            //find the closest parent row and remove it
            $(this).closest('tr').remove();
        });

    $('#OptionalData').click(function() {
            $("div.advanced").toggle('fast');

    });

    $('span.inputTitle').click(function() {
            var id = $(this).attr('id');
            $("div#help-" + id).toggle('fast');

    })

});
//]]>  
function addTitle(){

    var $newRow = $('#titleTemplateRow').clone(true);
    var lastIndex =  $('#rowTitle tr:last :input').attr("name");
    var re = new RegExp("([0-9]+)", "g");
    var match = lastIndex.match(re)[0];
    var intmatch = parseInt(match) + 1;
    $newRow.find('*').andSelf().removeAttr('id');
    $newRow.find(":input").each(function(){
        $(this).attr("name",function(i,v){
               return v.replace(re, intmatch );
        }).val("");
    });

    $newRow.find('button').remove();
     $('#rowTitle tr:last').after($newRow);


 // alert($("#Doc_creator_0_creatorName_@value").val());
}
