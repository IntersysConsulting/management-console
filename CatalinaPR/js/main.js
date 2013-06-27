var min_length=8;
var unamemaxlength=20;
var passmaxlength=15;
var server = "http://localhost:8080/CatalinaPR/";
var value,column,user_val,user_id_col,seg_id,segment_id_val,metric_id_value,super_cat_code,category_code;
var col_val,col_name,user_id_val,seg_id_val,index_id_val,index_val,metric_val,val,super_cat_id;
var timeout=25000;
var vTable;
var UpValue = [];
var i=0
function include(filename, onload) {
    var head = document.getElementsByTagName('head')[0];
    var script = document.createElement('script');
    script.src = filename;
    script.type = 'text/javascript';
    script.onload = script.onreadystatechange = function() {
        if (script.readyState) {
            if (script.readyState === 'complete' || script.readyState === 'loaded') {
                script.onreadystatechange = null;                                                  
                onload();
            }
        } 
        else {
            onload();          
        }
    };
    head.appendChild(script);
}
function GuardRails_Checking(value,column,user_val,metric_id_value)
{
    if(col_val=="")
    {
        col_val=value;
        col_name=column;
        user_val=user_val;
        metric_val=metric_id_value;
        var UP_Value = {  
            "col_nam" :col_name,                                
            "col_value" :col_val,
            "user_id_val" :user_val,
            "metric_id_val":metric_val
        };
                                    
        UpValue.push(UP_Value);
        return true;
    }
    else if(col_val!=value)
    {
        col_val=value;
        col_name=column;
        user_val=user_val;
        metric_val=metric_id_value;
        var UP_Value = {  
            "col_nam" :col_name,                                
            "col_value" :col_val,
            "user_id_val" :user_val,
            "metric_id_val":metric_val
        };
                                    
        UpValue.push(UP_Value);

        return true; 
    }
     $('#pgm_param_err').hide();                       
    $('#guard_rails_err').hide();
     $('#Val_control_err').hide();
    return true; 
}
function ProgramParams()
{
    jQuery('.home').stop().animate({height: 670, marginTop: 30}, 200);
    jQuery('.controls').stop().animate({height: 470}, 200);
}
function Controls()
{
    jQuery('.home').stop().animate({height: 580, marginTop: 70}, 200);
    jQuery('.controls').stop().animate({height: 370}, 200);
}
var make_button_active = function()
{
  //Get item siblings
  var siblings =($(this).siblings());

  //Remove active class on all buttons
  siblings.each(function (index)
    {
       
      $(this).removeClass('active');
    }
  )


  //Add the clicked button class
 $(this).addClass('active');
 
  //return true;
}
function MakeROIReport(user_val){

    
    var User=user_val;
    url=server+'php/ROIReportTable.php?user='+User;
     jQuery.ajax({
        type: "GET",
        url: url,
        timeout: 15000, //15 seconds
        error: function (jqXHR, strError) {
            
            if (strError == 'timeout') {
                jQuery('#CategoryTable').hide();
                jQuery('#CategoryNoData').show();
                jQuery('#CategoryNoData').html('Timed out fetching data...');
                
            }
        },
        dataType: "jsonp",
        jsonp: "callback",
        jsonpCallback: "roiCallback"
    });
 
}
function roiCallback(data){

 if (data != null ) {
   var roiValues = data['result'];  
    var product=roiValues['product'];
    roiData = new Array();

        jQuery(product).each(function (p) {

            var user_id='',cat_id=0,cat_code='',cat_desc='',pc_val='';

            if (this['user_id'] != null) {
                user_id = this['user_id'];
            }
            if (this['super_cat_id'] != null) {
                cat_id = this['super_cat_id'];
            }
            if (this['product_category_code'] != null) {
                cat_code = this['product_category_code'];
            }           
            if (this['product_category_desc'] != null) {
                cat_desc = this['product_category_desc'];
            }
            if (this['p_value'] != null) {
                pc_val = this['p_value'];
            }
            roiData.push([user_id, cat_id,cat_code, cat_desc, pc_val ]);

        });
       PlotProdCategoryTable(); 
    }
    else
        {
            alert('No Data Available to Load');
        }

}

function PlotProdCategoryTable()
{
     jQuery('#Prod_cat_code').show();
      jQuery('#Prod_cat_desc').show();
       jQuery('#pc_value').show();
   vTable = $('#ROIReport').dataTable({
            "aaData": roiData,
            "aoColumnDefs": [
            {"aTargets": [1], 
                "fnRender": function (obj) {
                    var sReturn = obj.aData[obj.iDataColumn];
                    count = obj.aData[obj.iDataColumn];
                     sReturn = "<div  class='segmentdesc' style='height:30px; width:360px; padding-top: 5%; font-size:14px; font-weight:bold;'> " + sReturn + "</div>";
                    return sReturn;
                }
            },
             {"aTargets": [2], 
                "fnRender": function (obj) {
                    var sReturn = obj.aData[obj.iDataColumn];
                     sReturn = "<div  class='segmentdesc' style='height:31px; padding-top: 3%; width:260px;font-size:14px; font-weight:bold;'> " + sReturn + "</div>";
                    return sReturn;
                }
            },
            {"aTargets": [3], 
                "fnRender": function (obj) {
                    var sReturn = obj.aData[obj.iDataColumn];
                     sReturn = '<input type="text" id="inp" name="prod_cats['+i+']" style="height:35px; text-align:center;font-size:12px; width:130px;" value="'+sReturn+'"/>';
                     i++;
                    return sReturn;
                }
            }
             ],
            "aoColumns": [
            {"sTitle": "#", "sClass": "cellCenter", "sWidth": "0%","bVisible": false},
            {"sTitle": "", "sClass": "cellCenter", "sWidth": "0%"},
            {"sTitle": "", "sClass": "cellCenter", "sWidth": "35%"},
            {"sTitle": "", "sClass": "cellCenter", "sWidth": "15%"}],
            "bJQueryUI": true,
            "bDestroy": true,
            "bPaginate": false,
            "bFilter": false,
            "bInfo": false,
            "bSort": false,
            "bAutoWidth": false,
            "bEditable":true
            
        });
}
include(server + 'js/jquery-1.7.1.min.js', function() {
    include(server + 'js/jquery.validate.js', function() {
        include(server + 'js/jquery.dataTables.min.js', function() {
            include(server + 'js/jquery.jqGrid.min.js', function() {
            $(document).ready(function() {
                $('#userid_error').hide();
                $('#passwrd_error').hide();
                $('#sales_change_err').hide();
                $('#roi_goals_err').hide();
                $('#roi_adj_err').hide();
                $('#pur_cycle_adj_err').hide();
                $('#cat_perf_err').hide();
                $('#hh_perf_err').hide();
                $('#guard_rails_err').hide();
                $('#Val_control_err').hide();
                $('#pgm_param_err').hide();
                jQuery('#Prod_cat_code').hide();
                  jQuery('#Prod_cat_desc').hide();
                   jQuery('#pc_value').hide();
                   jQuery('#prod_cat_err').hide();

                 $(".mainmenu ul li").click(make_button_active);
                 $("#click").click(function(){
                     var uname=document.getElementById("user_id").value;
                 MakeROIReport(uname);
                 });
                 
                jQuery('#submit').click(function () {
                    var uname=document.getElementById("userid").value;
                    var passwrd=document.getElementById("passwrd").value;
                    if(uname.length >= min_length && uname.length <= unamemaxlength && passwrd.length >= min_length && passwrd.length <= passmaxlength)  
                    {   
                  

                        return true;      
                    }  
                    else if((passwrd.length >= min_length && passwrd.length <= passmaxlength) && uname.length <= min_length || uname.length >= unamemaxlength  ) 
                    {       
            
                        $('#userid_error').show();
                        return false;     
                    } 
                    else if((passwrd.length <= min_length || passwrd.length >= passmaxlength) && uname.length >= min_length && uname.length <= unamemaxlength)  
                    {       
            
                        $('#passwrd_error').show();
                        return false;     
                    }  
                    else  
                    {       
          
                        $('#userid_error').show();
                        $('#passwrd_error').show();
                        return false;     
                    } 
                });
                jQuery('#login_cancel').click(function () {
                    document.getElementById("userid").value="";
                    document.getElementById("passwrd").value=""; 
                    $('#error').hide();
                    $('#userid_error').hide();
                    $('#passwrd_error').hide();
                });
                jQuery('#cancel').click(function () {
                    window.location.href = server+'php/DefaultHome.php';
                    return false;
                });
                jQuery('#pgm_cancel').click(function () {
                    window.location.href = server+'php/DefaultHome.php';
                    return false;
                });
                jQuery('#prod_cat_ancel').click(function () {
                    window.location.href = server+'php/DefaultHome.php';
                    return false;
                });
                $("[name^=inp_text]").each(function () {
                    $("[name^=inp_text]").live('input', function() {
                        $(this).blur(function(){
                            
                            value=this.value;
                            column=$(this).attr('id');
                            var name=$(this).attr('name');
                            var sb=name.substr(10,1);
                            user_val=document.getElementById("user_id['"+sb+"']").value;
                            segment_id_val=document.getElementById("segment_id['"+sb+"']").value;
                         
                                 
                            if((value>=(-0.10))&&(value<=(0.20))&&(value!=""))
                            {
                                if(col_val=="")
                                {
                                    
                                    col_val=value;
                                    col_name=column;
                                    user_val=user_val;
                                    seg_val=segment_id_val;
                                    var UP_Value = {  
                                        "col_nam" :col_name,                                
                                        "col_value" :col_val,
                                        "user_id_val" :user_val,
                                        "seg_id_val" :seg_val  
                                    };
                                    
                                    UpValue.push(UP_Value);
                                    return true;
                                }
                                else if(col_val!=value)
                                {
                                       
                                    col_val=value;
                                    col_name=column;
                                    user_val=user_val;
                                    seg_val=segment_id_val;
                                    var UP_Value = {  
                                        "col_nam" :col_name,                                
                                        "col_value" :col_val,
                                        "user_id_val" :user_val,
                                        "seg_id_val" :seg_val  
                                    };
                                    
                                    UpValue.push(UP_Value);

                                    return true; 
                                }
                            
                                $('#sales_change_err').hide();
                                return true; 
                            }
                            else if(value=="")
                            {
                                $('#sales_change_err').html('please enter a value');
                                $('#sales_change_err').show();
                                return false;
                            }
                            else
                            {
                                $('#sales_change_err').show();
                                return false;
                            }
                       
                        });
            
                    });
                });
            
                $('#save').click(function() {
                                
                    var Updated_Values = JSON.stringify(UpValue);
                    jQuery.ajax({
                        type: "POST",
                        url: server+"php/SalesChange_Update.php?arr="+Updated_Values,
                        data: {
                            'Updated_Values':Updated_Values
                        },
                    
                        success: function(data){
//                            if (data) {
//                                alert('no need' +data);
//                            }
//                                                     
//                            else {
//                                alert('updated'+ data);
//                                                                
//                            }
                        },
                        error:function(event){
                            alert('error'+event.message);
                        }
                    });  
                });
                $("[name^=roi_goals]").each(function () {
                    $("[name^=roi_goals]").live('input', function() {
                        $(this).blur(function(){
                            
                            value=this.value;
                            column=$(this).attr('id');
                            var name=$(this).attr('name');
                            var sb=name.substr(11,1);
                            user_val=document.getElementById("roi_goals_user_id['"+sb+"']").value;
                            segment_id_val=document.getElementById("roi_goals_segment_id['"+sb+"']").value;
                         
                                 
                            if((value>=(10))&&(value<=(120))&&(value!=""))
                            {
                                if(col_val=="")
                                {
                                    
                                    col_val=value;
                                    col_name=column;
                                    user_val=user_val;
                                    seg_val=segment_id_val;
                                    var UP_Value = {  
                                        "col_nam" :col_name,                                
                                        "col_value" :col_val,
                                        "user_id_val" :user_val,
                                        "seg_id_val" :seg_val  
                                    };
                                   
                                    UpValue.push(UP_Value);
                                    return true;
                                }
                                else if(col_val!=value)
                                {
                                       
                                    col_val=value;
                                    col_name=column;
                                    user_val=user_val;
                                    seg_val=segment_id_val;
                                    var UP_Value = {  
                                        "col_nam" :col_name,                                
                                        "col_value" :col_val,
                                        "user_id_val" :user_val,
                                        "seg_id_val" :seg_val  
                                    };
                                   
                                    UpValue.push(UP_Value);

                                    return true; 
                                }
                            
                                $('#roi_goals_err').hide();
                                return true; 
                            }
                            else if(value=="")
                            {
                                $('#roi_goals_err').html('please enter a value');
                                $('#roi_goals_err').show();
                                return false;
                            }
                            else
                            {
                                $('#roi_goals_err').show();
                                return false;
                            }
                       
                        });
            
                    });
                });
                $('#ROI_Goals_save').click(function() {
                                
                    var Updated_Values = JSON.stringify(UpValue);
                    jQuery.ajax({
                        type: "POST",
                        url: server+"php/ROIGoals_Update.php?arr="+Updated_Values,
                        data: {
                            'Updated_Values':Updated_Values
                        },
                    
                        success: function(data){
//                            if (data) {
//                                alert('no need' +data);
//                            }
//                                                     
//                            else {
//                                alert('updated'+ data);
//                                                                
//                            }
                        },
                        error:function(event){
                            alert('error'+event.message);
                        }
                    });  
                });
                $("[name^=roi_adj]").each(function () {
                    $("[name^=roi_adj]").live('input', function() {
                        $(this).blur(function(){
                            
                            value=this.value;
                            column=$(this).attr('id');
                            var name=$(this).attr('name');
                            var sb=name.substr(9,1);
                            user_val=document.getElementById("roi_adj_user_id['"+sb+"']").value;
                            if((value>=(0.00))&&(value<=(0.20))&&(value!=""))
                            {
                                if(col_val=="")
                                {
                                    
                                    col_val=value;
                                    col_name=column;
                                    user_val=user_val;
                                    //seg_val=segment_id_val;
                                    var UP_Value = {  
                                        "col_nam" :col_name,                                
                                        "col_value" :col_val,
                                        "user_id_val" :user_val
                                        
                                    };
                                    
                                    UpValue.push(UP_Value);
                                    return true;
                                }
                                else if(col_val!=value)
                                {
                                       
                                    col_val=value;
                                    col_name=column;
                                    user_val=user_val;
                                    //seg_val=segment_id_val;
                                    var UP_Value = {  
                                        "col_nam" :col_name,                                
                                        "col_value" :col_val,
                                        "user_id_val" :user_val
                                       
                                    };
                                    
                                    UpValue.push(UP_Value);

                                    return true; 
                                }
                            
                                $('#roi_adj_err').hide();
                                return true; 
                            }
                            else if(value=="")
                            {
                                $('#roi_adj_err').html('please enter a value');
                                $('#roi_adj_err').show();
                                return false;
                            }
                            else
                            {
                                $('#roi_adj_err').show();
                                return false;
                            }
                       
                        });
            
                    });
                });
                
                $('#roi_adj_save').click(function() {
                                
                    var Updated_Values = JSON.stringify(UpValue);
                   
                    jQuery.ajax({
                        type: "POST",
                        url: server+"php/ROIAdj_Update.php?arr="+Updated_Values,
                        data: {
                            'Updated_Values':Updated_Values
                        },
                    
                        success: function(data){
//                            if (data) {
//                                alert('updated' +data);
//                            }
//                                                     
//                            else {
//                                alert('no need'+ data);
//                                                                
//                            }
                        },
                        error:function(event){
                            alert('error'+event.message);
                        }
                    });  
                });
                
                $("[name^=pur_cyc]").each(function () {
                    $("[name^=pur_cyc]").live('input', function() {
                        $(this).blur(function(){
                            
                            value=this.value;
                            column=$(this).attr('id');
                            var name=$(this).attr('name');
                            var sb=name.substr(9,1);
                            user_val=document.getElementById("pur_cycle_user_id['"+sb+"']").value;
                            segment_id_val=document.getElementById("pur_cycle_segment_id['"+sb+"']").value;
                            if((value>=(30))&&(value<=(100))&&(value!=""))
                            {
                                if(col_val=="")
                                {
                                    col_val=value;
                                    col_name=column;
                                    user_val=user_val;
                                    seg_val=segment_id_val;
                                    var UP_Value = {  
                                        "col_nam" :col_name,                                
                                        "col_value" :col_val,
                                        "user_id_val" :user_val,
                                        "seg_id_val":seg_val
                                    };
                                    
                                    UpValue.push(UP_Value);
                                    return true;
                                }
                                else if(col_val!=value)
                                {
                                    col_val=value;
                                    col_name=column;
                                    user_val=user_val;
                                    seg_val=segment_id_val;
                                    var UP_Value = {  
                                        "col_nam" :col_name,                                
                                        "col_value" :col_val,
                                        "user_id_val" :user_val,
                                        "seg_id_val":seg_val
                                    };
                                    
                                    UpValue.push(UP_Value);

                                    return true; 
                                }
                            
                                $('#pur_cycle_adj_err').hide();
                                return true; 
                            }
                            else if(value=="")
                            {
                                $('#pur_cycle_adj_err').html('please enter a value');
                                $('#pur_cycle_adj_err').show();
                                return false;
                            }
                            else
                            {
                                $('#pur_cycle_adj_err').show();
                                return false;
                            }
                       
                        });
            
                    });
                });
                $('#pur_cycle_save').click(function() {
                                
                    var Updated_Values = JSON.stringify(UpValue);
                    jQuery.ajax({
                        type: "POST",
                        url: server+"php/PurchaseCycle_Update.php?arr="+Updated_Values,
                        data: {
                            'Updated_Values':Updated_Values
                        },
                    
                        success: function(data){
//                            if (data) {
//                                alert('updated' +data);
//                            }
//                                                     
//                            else {
//                                alert('no need'+ data);
//                                                                
//                            }
                        },
                        error:function(event){
                            alert('error'+event.message);
                        }
                    });  
                });
                
                $("[name^=cat_per]").each(function () {
                    $("[name^=cat_per]").live('input', function() {
                        $(this).blur(function(){
                           
                            value=this.value;
                            column=$(this).attr('id');
                            var name=$(this).attr('name');
                            var sb=name.substr(9,1);
                            user_val=document.getElementById("cat_per_user_id['"+sb+"']").value;
                            index_id_val=document.getElementById("cat-per_index_id['"+sb+"']").value;
                            if((value>=(5))&&(value<=(120))&&(value!=""))
                            {
                                if(col_val=="")
                                {
                                    col_val=value;
                                    col_name=column;
                                    user_val=user_val;
                                    index_val=index_id_val;
                                    var UP_Value = {  
                                        "col_nam" :col_name,                                
                                        "col_value" :col_val,
                                        "user_id_val" :user_val,
                                        "ind_id_val":index_val
                                    };
                                    
                                    UpValue.push(UP_Value);
                                    return true;
                                }
                                else if(col_val!=value)
                                {
                                    col_val=value;
                                    col_name=column;
                                    user_val=user_val;
                                    index_val=index_id_val;
                                    var UP_Value = {  
                                        "col_nam" :col_name,                                
                                        "col_value" :col_val,
                                        "user_id_val" :user_val,
                                        "ind_id_val":index_val
                                    };
                                    
                                    UpValue.push(UP_Value);

                                    return true; 
                                }
                            
                                $('#cat_perf_err').hide();
                                return true; 
                            }
                            else if(value=="")
                            {
                                $('#cat_perf_err').html('please enter a value');
                                $('#cat_perf_err').show();
                                return false;
                            }
                            else
                            {
                                $('#cat_perf_err').show();
                                return false;
                            }
                       
                        });
            
                    });
                });
                $('#cat_perf_save').click(function() {
                                
                    var Updated_Values = JSON.stringify(UpValue);
                    jQuery.ajax({
                        type: "POST",
                        url: server+"php/CategoryPerf_Update.php?arr="+Updated_Values,
                        data: {
                            'Updated_Values':Updated_Values
                        },
                    
                        success: function(data){
//                            if (data) {
//                                alert('updated' +data);
//                            }
//                                                     
//                            else {
//                                alert('no need'+ data);
//                                                                
//                            }
                        },
                        error:function(event){
                            alert('error'+event.message);
                        }
                    });  
                });
                $("[name^=hh_perf]").each(function () {
                    $("[name^=hh_perf]").live('input', function() {
                        $(this).blur(function(){
                           
                            value=this.value;
                            column=$(this).attr('id');
                            var name=$(this).attr('name');
                            var sb=name.substr(9,1);
                            user_val=document.getElementById("hh_perf_user_id['"+sb+"']").value;
                            index_id_val=document.getElementById("hh_perf_index_id['"+sb+"']").value;
                            if((value>=(-0.05))&&(value<=(0.05))&&(value!=""))
                            {
                                if(col_val=="")
                                {
                                    col_val=value;
                                    col_name=column;
                                    user_val=user_val;
                                    index_val=index_id_val;
                                    var UP_Value = {  
                                        "col_nam" :col_name,                                
                                        "col_value" :col_val,
                                        "user_id_val" :user_val,
                                        "ind_id_val":index_val
                                    };
                                    
                                    UpValue.push(UP_Value);
                                    return true;
                                }
                                else if(col_val!=value)
                                {
                                    col_val=value;
                                    col_name=column;
                                    user_val=user_val;
                                    index_val=index_id_val;
                                    var UP_Value = {  
                                        "col_nam" :col_name,                                
                                        "col_value" :col_val,
                                        "user_id_val" :user_val,
                                        "ind_id_val":index_val
                                    };
                                    
                                    UpValue.push(UP_Value);

                                    return true; 
                                }
                            
                                $('#hh_perf_err').hide();
                                return true; 
                            }
                            else if(value=="")
                            {
                                $('#hh_perf_err').html('please enter a value');
                                $('#hh_perf_err').show();
                                return false;
                            }
                            else
                            {
                                $('#hh_perf_err').show();
                                return false;
                            }
                       
                        });
            
                    });
                });
                $('#hh_perf_save').click(function() {
                                
                    var Updated_Values = JSON.stringify(UpValue);
                    jQuery.ajax({
                        type: "POST",
                        url: server+"php/HHPerf_Update.php?arr="+Updated_Values,
                        data: {
                            'Updated_Values':Updated_Values
                        },
                    
                        success: function(data){
//                            if (data) {
//                                alert('updated' +data);
//                            }
//                                                     
//                            else {
//                                alert('no need'+ data);
//                                                                
//                            }
                        },
                        error:function(event){
                            alert('error'+event.message);
                        }
                    });  
                });
                $("[name^=guard_rails]").each(function () {
                    $("[name^=guard_rails]").live('input', function() {
                        $(this).blur(function(){
                             
                            value=this.value;
                            column=$(this).attr('id');
                            var name=$(this).attr('name');
                            var sb=name.substr(13,1);
                            user_val=document.getElementById("guard_rails_user_id['"+sb+"']").value;
                            metric_id_value=document.getElementById("guard_rails_metric_id['"+sb+"']").value;
                            if(metric_id_value=='1'||metric_id_value=='2'){
                                if((value>=(30))&&(value<=(120))&&(value!=""))
                                {
                                    GuardRails_Checking(value,column,user_val,metric_id_value);
                                    
                                }
                                else if(value=="")
                                {
                                    $('#guard_rails_err').html('please enter a value');
                                    $('#guard_rails_err').show();
                                    return false;
                                }
                                else
                                {
                                    $('#guard_rails_err').html('Please Enter Value between 30 and 120');
                                    $('#guard_rails_err').show();
                                    return false;
                                }
                            }
                            else if((metric_id_value=='3') && (column=='minimum'))
                            {
                                if((value>=(2))&&(value<=(5))&&(value!=""))
                                {
                                    GuardRails_Checking(value,column,user_val,metric_id_value);
                                }
                                else if(value=="")
                                {
                                    $('#guard_rails_err').html('please enter a value');
                                    $('#guard_rails_err').show();
                                    return false;
                                }
                                else
                                {
                                    $('#guard_rails_err').html('Please Enter Minimum Value between $2 and $5 ');
                                    $('#guard_rails_err').show();
                                    return false;
                                } 
                                    
                            }
                            else if((metric_id_value=='3') && (column=='maximum'))
                            {
                                if((value>=(10))&&(value<=(100))&&(value!=""))
                                {
                                    GuardRails_Checking(value,column,user_val,metric_id_value);
                                }
                                else if(value=="")
                                {
                                    $('#guard_rails_err').html('please enter a value');
                                    $('#guard_rails_err').show();
                                    return false;
                                }
                                else
                                {
                                    $('#guard_rails_err').html('Please Enter Minimum Value between $10 and $100 ');
                                    $('#guard_rails_err').show();
                                    return false;
                                } 
                            }
                            else if((metric_id_value=='4') && (column=='minimum'))
                            {
                                if((value>=(1))&&(value<=(2))&&(value!=""))
                                {
                                    GuardRails_Checking(value,column,user_val,metric_id_value);
                                }
                                else if(value=="")
                                {
                                    $('#guard_rails_err').html('please enter a value');
                                    $('#guard_rails_err').show();
                                    return false;
                                }
                                else
                                {
                                    $('#guard_rails_err').html('Please Enter Minimum Value between $1 and $2 ');
                                    $('#guard_rails_err').show();
                                    return false;
                                }  
                            }
                            else if((metric_id_value=='4') && (column=='maximum'))
                            {
                                if((value>=(5))&&(value<=(25))&&(value!=""))
                                {
                                    GuardRails_Checking(value,column,user_val,metric_id_value);
                                }
                                else if(value=="")
                                {
                                    $('#guard_rails_err').html('please enter a value');
                                    $('#guard_rails_err').show();
                                    return false;
                                }
                                else
                                {
                                    $('#guard_rails_err').html('Please Enter Maximum Value between $5 and $25 ');
                                    $('#guard_rails_err').show();
                                    return false;
                                }  
                            }
                       
                        });
            
                    });
                });
                $('#guard_rails_save').click(function() {
                                
                    var Updated_Values = JSON.stringify(UpValue);
                    jQuery.ajax({
                        type: "POST",
                        url: server+"php/GuardRails_Update.php?arr="+Updated_Values,
                        data: {
                            'Updated_Values':Updated_Values
                        },
                    
                        success: function(data){
//                            if (data) {
//                                alert('updated' +data);
//                            }
//                                                     
//                            else {
//                                alert('no need'+ data);
//                                                                
//                            }
                        },
                        error:function(event){
                            alert('error'+event.message);
                        }
                    });  
                });
                
                $("[name^=val_con]").each(function () {
                    $("[name^=val_con]").live('input', function() {
                        $(this).blur(function(){
                            value=this.value;
                            column=$(this).attr('id');
                            var name=$(this).attr('name');
                            var sb=name.substr(9,1);
                            user_val=document.getElementById("val_control_user_id['"+sb+"']").value;
                            metric_id_value=document.getElementById("val_control_metric_id['"+sb+"']").value;
                            if((metric_id_value=='1')&&((column=='minimum'))){
                                if((value>=(0))&&(value<=(120))&&(value!=""))
                                {
                                    GuardRails_Checking(value,column,user_val,metric_id_value);
                                    
                                }
                                else if(value=="")
                                {
                                    $('#Val_control_err').html('Please enter a value');
                                    $('#Val_control_err').show();
                                    return false;
                                }
                                else
                                {
                                    $('#Val_control_err').html('Please Enter Value between 0 and 120');
                                    $('#Val_control_err').show();
                                    return false;
                                }
                            }
                            else if((metric_id_value=='1')&&((column=='maximum')))
                                {
                                     if((value>=(0))&&(value<=(120))&&(value!=""))
                                {
                                    GuardRails_Checking(value,column,user_val,metric_id_value);
                                    
                                }
                                else if(value=="")
                                {
                                    $('#Val_control_err').html('Please enter a value');
                                    $('#Val_control_err').show();
                                    return false;
                                }
                                else
                                {
                                    $('#Val_control_err').html('Please Enter Value between 0 and 120');
                                    $('#Val_control_err').show();
                                    return false;
                                }
                                }
                            else if((metric_id_value=='2'))
                            {
                                if((value>=(10))&&(value<=(120))&&(value!=""))
                                {
                                    GuardRails_Checking(value,column,user_val,metric_id_value);
                                }
                                else if(value=="")
                                {
                                    $('#Val_control_err').html('please enter a value');
                                    $('#Val_control_err').show();
                                    return false;
                                }
                                else
                                {
                                    $('#Val_control_err').html('Please Enter Value between 10 and 120 ');
                                    $('#Val_control_err').show();
                                    return false;
                                } 
                                    
                            }
                            else if((metric_id_value=='3'))
                            {
                                if((value>=(1))&&(value<=(30))&&(value!=""))
                                {
                                    GuardRails_Checking(value,column,user_val,metric_id_value);
                                }
                                else if(value=="")
                                {
                                    $('#Val_control_err').html('please enter a value');
                                    $('#Val_control_err').show();
                                    return false;
                                }
                                else
                                {
                                    $('#Val_control_err').html('Please Enter Value between 1 and 30 ');
                                    $('#Val_control_err').show();
                                    return false;
                                } 
                                    
                            }
                            else if((metric_id_value=='4'))
                            {
                                if((value>=(30))&&(value<=(100))&&(value!=""))
                                {
                                    GuardRails_Checking(value,column,user_val,metric_id_value);
                                }
                                else if(value=="")
                                {
                                    $('#Val_control_err').html('please enter a value');
                                    $('#Val_control_err').show();
                                    return false;
                                }
                                else
                                {
                                    $('#Val_control_err').html('Please Enter Value between 30 and 100 ');
                                    $('#Val_control_err').show();
                                    return false;
                                } 
                            }
                            else if((metric_id_value=='5'))
                            {
                                if((value>=(5))&&(value<=(120))&&(value!=""))
                                {
                                    GuardRails_Checking(value,column,user_val,metric_id_value);
                                }
                                else if(value=="")
                                {
                                    $('#Val_control_err').html('please enter a value');
                                    $('#Val_control_err').show();
                                    return false;
                                }
                                else
                                {
                                    $('#Val_control_err').html('Please Enter Value between 5 and 120 ');
                                    $('#Val_control_err').show();
                                    return false;
                                } 
                            }
                            else if((metric_id_value=='6'))
                            {
                                if((value>=(30))&&(value<=(120))&&(value!=""))
                                {
                                    GuardRails_Checking(value,column,user_val,metric_id_value);
                                }
                                else if(value=="")
                                {
                                    $('#Val_control_err').html('please enter a value');
                                    $('#Val_control_err').show();
                                    return false;
                                }
                                else
                                {
                                    $('#Val_control_err').html('Please Enter Value between 30 and 120 ');
                                    $('#Val_control_err').show();
                                    return false;
                                }  
                            }
                            else if((metric_id_value=='7'))
                            {
                                if((value>=(30))&&(value<=(50))&&(value!=""))
                                {
                                    GuardRails_Checking(value,column,user_val,metric_id_value);
                                }
                                else if(value=="")
                                {
                                    $('#Val_control_err').html('please enter a value');
                                    $('#Val_control_err').show();
                                    return false;
                                }
                                else
                                {
                                    $('#Val_control_err').html('Please Enter  Value between 30 and 50 ');
                                    $('#Val_control_err').show();
                                    return false;
                                }  
                            }
                            else if((metric_id_value=='8'))
                            {
                                if((value>=(5))&&(value<=(100))&&(value!=""))
                                {
                                    GuardRails_Checking(value,column,user_val,metric_id_value);
                                }
                                else if(value=="")
                                {
                                    $('#Val_control_err').html('please enter a value');
                                    $('#Val_control_err').show();
                                    return false;
                                }
                                else
                                {
                                    $('#Val_control_err').html('Please Enter Value between 5 and 100 ');
                                    $('#Val_control_err').show();
                                    return false;
                                }  
                            }
                            else if((metric_id_value=='9'))
                            {
                                if((value>=(1))&&(value<=(25))&&(value!=""))
                                {
                                    GuardRails_Checking(value,column,user_val,metric_id_value);
                                }
                                else if(value=="")
                                {
                                    $('#Val_control_err').html('please enter a value');
                                    $('#Val_control_err').show();
                                    return false;
                                }
                                else
                                {
                                    $('#Val_control_err').html('Please Enter Value between 1 and 25 ');
                                    $('#Val_control_err').show();
                                    return false;
                                }  
                            }
                       
                        });
            
                    });
                });
                $('#val_control_save').click(function() {
                                
                    var Updated_Values = JSON.stringify(UpValue);
                   //alert(Updated_Values);
                    jQuery.ajax({
                        type: "POST",
                        url: server+"php/ValControls_Update.php?arr="+Updated_Values,
                        data: {
                            'Updated_Values':Updated_Values
                        },
                    
                        success: function(data){
//                            if (data) {
//                                alert('updated' +data);
//                            }
//                                                     
//                            else {
//                                alert('no need'+ data);
//                                                                
//                           }
                        },
                        error:function(event){
                            alert('error'+event.message);
                        }
                    });  
                });
              
                 $("[name^=pgm_param]").each(function () {
                    $("[name^=pgm_param]").live('input', function() {
                        $(this).blur(function(){
                            value=this.value;
                            column=$(this).attr('id');
                            var name=$(this).attr('name');
                            var sb=name.substr(11,1);
                            user_val=document.getElementById("pgm_param_user_id['"+sb+"']").value;
                            parameters=document.getElementById("pgm_parameter['"+sb+"']").value;
                            parameter=document.getElementById("pgm_parameter_id['"+sb+"']").value;
                            parameters=parameters.toUpperCase();
                            if(parameters=='RETAIN PREVIOUS OFFERS(# OF PURCHASE CYCLES )'){
                                if((value>=1)&&(value<=10)&&(value!=""))
                                {
                                    GuardRails_Checking(value,column,user_val,parameter);
                                    
                                }
                                else if(value=="")
                                {
                                    $('#pgm_param_err').html('Please enter a value');
                                    $('#pgm_param_err').show();
                                    return false;
                                }
                                else
                                {
                                    $('#pgm_param_err').html('Please Enter Value between 1 and 10');
                                    $('#pgm_param_err').show();
                                    return false;
                                }
                            }
                            else if((parameters=='REWARD/PURCHASE CATEGORY REPETITION(NOT ALLOWED FOR # OF PURCHASE CYCLES)'))
                            {
                                if((value>=(1))&&(value<=(5))&&(value!=""))
                                {
                                    GuardRails_Checking(value,column,user_val,parameter);
                                }
                                else if(value=="")
                                {
                                    $('#pgm_param_err').html('please enter a value');
                                    $('#pgm_param_err').show();
                                    return false;
                                }
                                else
                                {
                                    $('#pgm_param_err').html('Please Enter Value between 1 and 5 ');
                                    $('#pgm_param_err').show();
                                    return false;
                                } 
                                    
                            }
                            else if((parameters=='ROUNDING CRITERIA FOR SPEND THRESHOLDS($ INCREMENT)'))
                            {
                                if((value>=(1))&&(value<=(5))&&(value!=""))
                                {
                                    GuardRails_Checking(value,column,user_val,parameter);
                                }
                                else if(value=="")
                                {
                                    $('#pgm_param_err').html('please enter a value');
                                    $('#pgm_param_err').show();
                                    return false;
                                }
                                else
                                {
                                    $('#pgm_param_err').html('Please Enter Value between $1 and $5 ');
                                    $('#pgm_param_err').show();
                                    return false;
                                } 
                                    
                            }
                            else if((parameters=='ROUNDING CRITERIA FOR REWARD AMOUNT($ INCREMENT)'))
                            {
                                if((value>=(5))&&(value<=(7))&&(value!=""))
                                {
                                    GuardRails_Checking(value,column,user_val,parameter);
                                }
                                else if(value=="")
                                {
                                    $('#pgm_param_err').html('please enter a value');
                                    $('#pgm_param_err').show();
                                    return false;
                                }
                                else
                                {
                                    $('#pgm_param_err').html('Please Enter Value between $5 and $7 ');
                                    $('#pgm_param_err').show();
                                    return false;
                                } 
                            }
                            else if((parameters=='ALLOW COLLISIONS(SAME PURCHASE OR REWARD CATEGORIES IN MULTIPLE OFFERS)'))
                            {
                                if((value==('YES'))||(value==('NO')||(value=='yes')||(value=='no'))&&(value!=""))
                                {
                                    GuardRails_Checking(value,column,user_val,parameter);
                                }
                                else if(value=="")
                                {
                                    $('#pgm_param_err').html('please enter a value');
                                    $('#pgm_param_err').show();
                                    return false;
                                }
                                else
                                {
                                    $('#pgm_param_err').html('Please Enter Value YES/NO ');
                                    $('#pgm_param_err').show();
                                    return false;
                                } 
                            }
                            else if((parameters=='# OF DEFAULT OFFERS'))
                            {
                                if((value>=(1))&&(value<=(5))&&(value!=""))
                                {
                                    GuardRails_Checking(value,column,user_val,parameter);
                                }
                                else if(value=="")
                                {
                                    $('#pgm_param_err').html('please enter a value');
                                    $('#pgm_param_err').show();
                                    return false;
                                }
                                else
                                {
                                    $('#pgm_param_err').html('Please Enter Value between 1 and 5 ');
                                    $('#pgm_param_err').show();
                                    return false;
                                }  
                            }
                            else if((parameters=='ALLOW REWARD CATEGORY REPETITION IN CURRENT OFFERS'))
                            {
                                if(((value=="YES")||(value=="NO")||(value=="yes")||(value=="no"))&&(value!=""))
                                {
                                    GuardRails_Checking(value,column,user_val,parameter);
                                }
                                else if(value=="")
                                {
                                    $('#pgm_param_err').html('please enter a value');
                                    $('#pgm_param_err').show();
                                    return false;
                                }
                                else
                                {
                                    $('#pgm_param_err').html('Please Enter Value between 30 and 50 ');
                                    $('#pgm_param_err').show();
                                    return false;
                                }  
                            }

                            
                       
                        });
            
                    });
                });
                $('#drp_dwn_segment').live('change', function(e) {
                     value=(e.target.options[e.target.selectedIndex].text);
                     column='p_value';
                      user_val=document.getElementById("pgm_param_user_id['0']").value;
                      parameter=8;
                     GuardRails_Checking(value,column,user_val,parameter);
                    });
                $('#pgm_param_save').click(function() {
                                
                    var Updated_Values = JSON.stringify(UpValue);
                    //alert(Updated_Values);
                    jQuery.ajax({
                        type: "POST",
                        url: server+"php/ProgramParameter_Update.php?arr="+Updated_Values,
                        data: {
                            'Updated_Values':Updated_Values
                        },
                    
                        success: function(data){
//                            if (data) {
//                                alert('updated' +data);
//                            }
//                                                     
//                            else {
//                                alert('no need'+ data);
//                                                                
//                            }
                        },
                        error:function(event){
                            alert('error'+event.message);
                        }
                    });  
                });
                
                $('#drp_dwn_super_category').live('change', function(e) {
                     desc=(e.target.options[e.target.selectedIndex].text);
                    val=(e.target.options[e.target.selectedIndex].value);
                      user_val=document.getElementById("username").value;
                          $.post(server+'php/EligibleProduct.php?sup_id='+val, {"sup_id": val}, function (txt) {
                                
                                    $('#sample').html(txt);
                                    $('#sample #headings').hide();
                                    $('#sample #drp_dwn_super_category').hide();
                                    $('#sample #super').hide();
                                     
                                     $('#sample #pro_cat_save').hide();
                                     $('#sample #prod_cat_ancel').hide();
                                    
                            });
                    });
                    
                   $("[name^=prod_cat]").each(function () {
                    $("[name^=prod_cat]").live('input', function() { 
                        $(this).blur(function(){
                           
                            value=this.value;
                            column=$(this).attr('id');
                            var name=$(this).attr('name');
                            var sb=name.substr(9,1);
                            user_val=document.getElementById("prod_cat_user_id["+sb+"]").value;
                            super_cat_code=document.getElementById("super_cat_code["+sb+"]").value;
                            super_cat_id=document.getElementById("super_cat_id["+sb+"]").value;
                            if(((value=='YES')||(value=='NO')||(value=='yes')||(value=='no')||value=='Yes'||(value=='No'))&&(value!=""))
                                {
                                    
                               if(col_val=="")
                                {
                                    col_val=value;
                                    col_name=column;
                                    user_val=user_val;
                                    index_val=super_cat_id;
                                    category_code=super_cat_code;
                                    var UP_Value = {  
                                        "col_nam" :col_name,                                
                                        "col_value" :col_val,
                                        "user_id_val" :user_val,
                                        "sup_id_val":index_val,
                                        "cat_code":category_code
                                    };
                                    
                                    UpValue.push(UP_Value);
                                    return true;
                                }
                                else if(col_val!=value)
                                {
                                    col_val=value;
                                    col_name=column;
                                    user_val=user_val;
                                    index_val=super_cat_id;
                                     category_code=super_cat_code;
                                    var UP_Value = {  
                                        "col_nam" :col_name,                                
                                        "col_value" :col_val,
                                        "user_id_val" :user_val,
                                        "sup_id_val":index_val,
                                        "cat_code":category_code
                                    };
                                    
                                    UpValue.push(UP_Value);

                                    return true; 
                                }
                            
                                $('#prod_cat_err').hide();
                                return true; 
                            }
                            else if(value=="")
                            {
                                $('#prod_cat_err').html('please enter a value');
                                $('#prod_cat_err').show();
                                return false;
                            }
                            else
                            {
                                $('#prod_cat_err').show();
                                return false;
                            }
                       
                            
                        });
                    });
                   });
                   
             $('#pro_cat_save').click(function() {
                                
                    var Updated_Values = JSON.stringify(UpValue);
                    
                    jQuery.ajax({
                        type: "POST",
                        url: server+"php/EligibleProducts_Update.php?arr="+Updated_Values,
                        data: {
                            'Updated_Values':Updated_Values
                        },
                    
                        success: function(data){
//                            if (data) {
//                                alert('updated' +data);
//                            }
//                                                     
//                            else {
//                                alert('no need'+ data);
//                                                                
//                            }
                        },
                        error:function(event){
                            alert('error'+event.message);
                        }
                    });  
                });

            
             
              
            });     
            });
        });
     });
});
