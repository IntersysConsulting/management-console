var min_length=8;
var unamemaxlength=20;
var passmaxlength=15;
var server = "http://stptmpplnxv01/";
var value,column,user_val,user_id_col,seg_id,segment_id_val,metric_id_value,super_cat_code,category_code;
var col_val,col_name,user_id_val,seg_id_val,index_id_val,index_val,metric_val,val,super_cat_id;
var timeout=25000;

var UpValue = [];
var i=0,f=false,edit=false;


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
    try{
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
                                    
            UpValue.push(UP_Value);f=true;
            $('#pgm_param_err').hide();                       
            $('#guard_rails_err').hide();
            $('#Val_control_err').hide();
            f=true;
            return true;
        }
        else if(col_val!=value||(col_name!=column && col_val==value)||(metric_val!=metric_id_value && col_val==value))
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
                                    
            UpValue.push(UP_Value);f=true;
            $('#pgm_param_err').hide();                       
            $('#guard_rails_err').hide();
            $('#Val_control_err').hide();
            f=true;
            return true; 
        }
    
   
    }
    catch(e)
    {
        alert(e.message)
    }
}
function ProgramParams()
{
    try{
        jQuery('.home').stop().animate({
            height: 670, 
            marginTop: 30
        }, 200);
        jQuery('.controls').stop().animate({
            height: 470
        }, 200);
    }
    catch(e)
    {
        alert(e.message);
    }
}
function Controls()
{
    jQuery('.home').stop().animate({
        height: 620, 
        marginTop: 70
    }, 200);
    jQuery('.controls').stop().animate({
        height: 400
    }, 200);
}
var make_button_active = function()
{
    //Get item siblings
    var siblings =($(this).siblings());

    //Remove active class on all buttons
    siblings.each(function (index)
    {
       
        $(this).removeClass('active');
    })
    //Add the clicked button class
    $(this).addClass('active');
}

include(server + 'js/jquery-1.7.1.min.js', function() {
    include(server + 'js/jquery.validate.js', function() {
        include(server + 'js/jquery-ui.js', function() {
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
                    $('#Prod_cat_code').hide();
                    $('#Prod_cat_desc').hide();
                    $('#pc_value').hide();
                    $('#prod_cat_err').hide();
                    $('#updating').hide();
                    $('#roi_goal_updating').hide();
                    $('#roi_adj_updating').hide();
                    $('#pur_cyc_updating').hide();
                    $('#cat_perf_updating').hide();
                    $('#hh_perf_updating').hide();
                    $('#pgm_param_updating').hide();
                    $('#prod_cat_updating').hide();
                    $(".mainmenu ul li").click(make_button_active);
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
                    jQuery('#roi_adj_cancel').click(function () {
                        window.location.href = server+'php/DefaultHome.php';
                        return false;
                    });
                    jQuery('#roi_goals_cancel').click(function () {
                        window.location.href = server+'php/DefaultHome.php';
                        return false;
                    });
                    jQuery('#purch_cylce_adj_cancel').click(function () {
                        window.location.href = server+'php/DefaultHome.php';
                        return false;
                    });
                    jQuery('#cat_perf_cancel').click(function () {
                        window.location.href = server+'php/DefaultHome.php';
                        return false;
                    });
                    jQuery('#hh_perf_cancel').click(function () {
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
                        $.data(this, 'default', this.value);
                    }).css("color","black")
                    .focus(function() {
                        if (!$.data(this, 'edited')) {
                            $(this).css("color","black");
                        }
                    }).change(function() {
                        $.data(this, 'edited', this.value != "");
                    }).blur(function() {
                        if ($.data(this, 'edited')) {
                            $('#updating').hide();
                            edit=true;
                            value=this.value;
                            column=$(this).attr('id');
                            var name=$(this).attr('name');
                            var sb=name.substr(10,1);
                            user_val=document.getElementById("user_id['"+sb+"']").value;
                            segment_id_val=document.getElementById("segment_id['"+sb+"']").value;
                            if((this.value>=(-0.10))&&(this.value<=(0.20))&&(this.value!="")){
                                $(this).css("background-color","white");
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
                                    $('#sales_change_err').hide();
                                    f=true;
                                    return true;
                                }
                                else if(col_val!=value||(col_name!=column && col_val==value)||(seg_val!=segment_id_val && col_val==value))
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
                                    $('#sales_change_err').hide();
                                    f=true;
                                    return true; 
                                }
                           
                            }
                            else
                            {
                                $(this).css("background-color","red");
                                $('#sales_change_err').html('Please enter value between -0.10 and 0.20');
                                $('#sales_change_err').show();
                                f=false;
                                return false;
                                    
                            }
                        }
                        if(this.value==null || this.value==""){
                            $(this).css("background-color","yellow");
                            $('#sales_change_err').html('Please enter a value');
                            $('#sales_change_err').show();
                            f=false;

                        }
                   
                   
                    
                    });
             
                    
                         
                    $('#save').click(function() {
                        var Updated_Values = JSON.stringify(UpValue);
                        if(f==true){
                            var r=confirm('Do you Want to Update?')
                            if(r==true){
                      
                                jQuery.ajax({
                                    type: "POST",
                                    url: server+"php/SalesChange_Update.php?arr="+Updated_Values,
                                    data: {
                                        'Updated_Values':Updated_Values
                                    },
                                    success: function(data){
                                        if (data) {
                                            $('#updating').show();
                                        }
                                        else {
                                            $('#updating').html('Update Failed');
                                            $('#updating').show();
                                        }
                                    },
                                    error:function(event){
                                        alert('error'+event.message);
                                    }
                                });
                            }
                        }
                        else
                        {
                            if(edit==true){
                                $('#sales_change_err').html('Please enter value between -0.10 and 0.20');
                                $('#sales_change_err').show();
                            }
                            else
                            {
                                $('#sales_change_err').html('No Changes');
                                $('#sales_change_err').show();
                            }
                        }
                    });
                    
                    $("[name^=roi_goals]").each(function () {
                        $.data(this, 'default', this.value);
                    }).css("color","black")
                    .focus(function() {
                        if (!$.data(this, 'edited')) {
                            $(this).css("color","black");
                        }
                    }).change(function() {
                        $.data(this, 'edited', this.value != "");
                    }).blur(function() {
                        if ($.data(this, 'edited')) {
                            
                            edit=true;
                            $('#roi_goal_updating').hide();
                            value=this.value;
                            column=$(this).attr('id');
                            var name=$(this).attr('name');
                            var sb=name.substr(11,1);
                            user_val=document.getElementById("roi_goals_user_id['"+sb+"']").value;
                            segment_id_val=document.getElementById("roi_goals_segment_id['"+sb+"']").value;
                         
                                 
                            if((this.value>=(10))&&(this.value<=(120))&&(this.value!=""))
                            {
                                $(this).css("background-color","white");
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
                                    f=true;
                                    $('#roi_goals_err').hide();
                                    return true;
                                }
                                else if(col_val!=value||(col_name!=column && col_val==value)||(seg_val!=segment_id_val && col_val==value))
                                    
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
                                    f=true;
                                    $('#roi_goals_err').hide();
                                    return true; 
                                }
                            
                                $('#roi_goals_err').hide();
                                return true; 
                            }
                               
                            else{
                                
                                $(this).css("background-color","red");
                                $('#roi_goals_err').html('Please enter value between 10 to 120');
                                $('#roi_goals_err').show();
                                f=false;
                                return false;
                            }
                        }
                        if(this.value=="")
                        {
                            $(this).css("background-color","yellow");
                            $('#roi_goals_err').html('Please enter a value');
                            $('#roi_goals_err').show();
                            f=false;
                            return false;
                        }
                       
                    
                    });
                    
                    $('#ROI_Goals_save').click(function() {
                                
                        var Updated_Values = JSON.stringify(UpValue);
                        if(f==true){
                            var r=confirm('Do you Want to Update?');
                            if(r==true){
                                jQuery.ajax({
                                    type: "POST",
                                    url: server+"php/ROIGoals_Update.php?arr="+Updated_Values,
                                    data: {
                                        'Updated_Values':Updated_Values
                                    },
                                    success: function(data){
                                        if (data) {
                                        //    $('#roi_goal_updating').html('Update Failed');
                                            $('#roi_goal_updating').show();
                                        }
                                        else {
					    $('#roi_goal_updating').html('Update Failed');
                                            $('#roi_goal_updating').show();
                                        }
                                    },
                                    error:function(event){
                                        alert('error'+event.message);
                                    }
                                }); 
                            }
                        }
                        else
                        {
                            if(edit==true){
                                $('#roi_goals_err').html('Please enter value between 10 to 120');
                                $('#roi_goals_err').show(); 
                            }
                            else
                            {
                                $('#roi_goals_err').html('No Changes');
                                $('#roi_goals_err').show();      
                            }
                        }
                    });
                    $("[name^=roi_adj]").each(function () {
                        $.data(this, 'default', this.value);
                    }).css("color","black")
                    .focus(function() {
                        if (!$.data(this, 'edited')) {
                            $(this).css("color","black");
                        }
                    }).change(function() {
                        $.data(this, 'edited', this.value != "");
                    }).blur(function() {
                        if ($.data(this, 'edited')) {
                            
                            $('#roi_adj_updating').hide();
                            edit=true;
                            value=this.value;
                            column=$(this).attr('id');
                            var name=$(this).attr('name');
                            var sb=name.substr(9,1);
                            user_val=document.getElementById("roi_adj_user_id['"+sb+"']").value;
                            if((this.value>=(0.00))&&(this.value<=(0.20))&&(this.value!=""))
                            {
                                $(this).css("background-color","white");
                                if(col_val=="")
                                {
                                    
                                    col_val=value;
                                    col_name=column;
                                    user_val=user_val;
                                    
                                    var UP_Value = {  
                                        "col_nam" :col_name,                                
                                        "col_value" :col_val,
                                        "user_id_val" :user_val
                                        
                                    };
                                    
                                    UpValue.push(UP_Value);
                                    f=true;
                                    $('#roi_adj_err').hide();
                                    return true;
                                }
                                else if(col_val!=value||(col_name!=column && col_val==value))
                                {
                                       
                                    col_val=value;
                                    col_name=column;
                                    user_val=user_val;
                                    
                                    var UP_Value = {  
                                        "col_nam" :col_name,                                
                                        "col_value" :col_val,
                                        "user_id_val" :user_val
                                       
                                    };
                                    
                                    UpValue.push(UP_Value);
                                    f=true;
                                    $('#roi_adj_err').hide();
                                    return true; 
                                }
                            
                            
                            }
                            
                            else
                            {
                                $(this).css("background-color","red");
                                $('#roi_adj_err').html('Please enter value between 0 and .20');
                                $('#roi_adj_err').show();
                                f=false;
                                return false;
                            }
                        }
                        if(this.value=="")
                        {
                            $(this).css("background-color","yellow");
                            $('#roi_adj_err').html('Please enter a value');
                            $('#roi_adj_err').show();
                            f=false;
                            return false;
                        }
                    
                    });
                    
                    $('#roi_adj_save').click(function() {
                        var Updated_Values = JSON.stringify(UpValue);
                        if(f==true){
                            var r=confirm('Do you Want to Update?');
                            if(r==true){
                                jQuery.ajax({
                                    type: "POST",
                                    url: server+"php/ROIAdj_Update.php?arr="+Updated_Values,
                                    data: {
                                        'Updated_Values':Updated_Values
                                    },
                                    success: function(data){
                                        if (data) {
                                 
                                            $('#roi_adj_updating').show();
                                        }
                                        else {
                                            $('#roi_adj_updating').html('Update Failed');
                                            $('#roi_adj_updating').show();
                                        }
                                    },
                                    error:function(event){
                                        alert('error'+event.message);
                                    }
                                }); 
                            }
                        }
                        else
                        {
                            if(edit==true){
                            $('#roi_adj_err').show();  
                            }
                            else
                            {
                                $('#roi_adj_err').html('NO Changes'); 
                                $('#roi_adj_err').show(); 
                            }
                        }
                    });
                
                    $("[name^=pur_cyc]").each(function () {
                        $.data(this, 'default', this.value);
                    }).css("color","black")
                    .focus(function() {
                        if (!$.data(this, 'edited')) {
                            $(this).css("color","black");
                        }
                    }).change(function() {
                        $.data(this, 'edited', this.value != "");
                    }).blur(function() {
                        if ($.data(this, 'edited')) {
                            
                            $('#pur_cyc_updating').hide();
                            edit=true;
                            value=this.value;
                            column=$(this).attr('id');
                            var name=$(this).attr('name');
                            var sb=name.substr(9,1);
                            user_val=document.getElementById("pur_cycle_user_id['"+sb+"']").value;
                            segment_id_val=document.getElementById("pur_cycle_segment_id['"+sb+"']").value;
                            if((this.value>=(30))&&(this.value<=(100))&&(this.value!=""))
                            {
                                $(this).css("background-color","white");
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
                                    f=true;
                                    $('#pur_cycle_adj_err').hide();
                                    return true;
                                }
                                else if(col_val!=value||(col_name!=column && col_val==value)||(seg_val!=segment_id_val && col_val==value))
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
                                    f=true;
                                    $('#pur_cycle_adj_err').hide();
                                    return true; 
                                }
                            
                            
                            }
                       
                            else
                            {
                                $(this).css("background-color","red");
                                $('#pur_cycle_adj_err').html('Please enter value between 30 and 100');
                                $('#pur_cycle_adj_err').show();
                                f=false;
                                return false;
                            }
                        
                        }
                        if(this.value=="")
                        {
                            $(this).css("background-color","yellow");
                            $('#pur_cycle_adj_err').html('Please enter a value');
                            $('#pur_cycle_adj_err').show();
                            f=false;
                            return false;
                        }
                    
                    });
                    
                    $('#pur_cycle_save').click(function() {
                                
                        var Updated_Values = JSON.stringify(UpValue);
                        if(f==true){
                            var r=confirm('Do you Want to update?');
                            if(r==true){
                                jQuery.ajax({
                                    type: "POST",
                                    url: server+"php/PurchaseCycle_Update.php?arr="+Updated_Values,
                                    data: {
                                        'Updated_Values':Updated_Values
                                    },
                    
                                    success: function(data){
                                        if (data) {
                                       //     $('#pur_cyc_updating').html('Update Failed');
                                            $('#pur_cyc_updating').show();
                                        }
                                        else {
                                	     $('#pur_cyc_updating').html('Update Failed'); 
                                            $('#pur_cyc_updating').show();
                                        }
                                    },
                                    error:function(event){
                                        alert('error'+event.message);
                                    }
                                });
                            }
                        }
                        else
                        {
                            if(edit==true){
                            $('#pur_cycle_adj_err').show(); 
                            }
                            else
                             {
                                $('#pur_cycle_adj_err').html('No Changes');
                                $('#pur_cycle_adj_err').show();
                             }
                        }
                    });
                
                    $("[name^=cat_per]").each(function () {
                        $.data(this, 'default', this.value);
                    }).css("color","black")
                    .focus(function() {
                        if (!$.data(this, 'edited')) {
                            $(this).css("color","black");
                        }
                    }).change(function() {
                        $.data(this, 'edited', this.value != "");
                    }).blur(function() {
                        if ($.data(this, 'edited')) {
                            
                            $('#cat_perf_updating').hide();
                            edit=true;
                            value=this.value;
                            column=$(this).attr('id');
                            var name=$(this).attr('name');
                            var sb=name.substr(9,1);
                            user_val=document.getElementById("cat_per_user_id['"+sb+"']").value;
                            index_id_val=document.getElementById("cat-per_index_id['"+sb+"']").value;
                            if((this.value>=(5))&&(this.value<=(120))&&(this.value!=""))
                            {
                                $(this).css("background-color","white");
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
                                    f=true;
                                    $('#cat_perf_err').hide();
                                    return true;
                                }
                                else if(col_val!=value||(col_name!=column && col_val==value)||(index_val!=index_id_val && col_val==value))
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
                                    f=true;
                                    $('#cat_perf_err').hide();
                                    return true; 
                                }
                            
                            
                            }
                       
                            else
                            {
                                $(this).css("background-color","red");
                                $('#cat_perf_err').html('Please enter value between 5 to 120');
                                $('#cat_perf_err').show();
                                f=false;
                                return false;
                            }
                        }
                        if(this.value=="")
                        {
                            $(this).css("background-color","yellow");
                            $('#cat_perf_err').html('Please enter a value');
                            $('#cat_perf_err').show();
                            f=false;
                            return false;
                        }
                    
                    });
                   
                    $('#cat_perf_save').click(function() {
                                
                        var Updated_Values = JSON.stringify(UpValue);
                        if(f==true){
                            var r=confirm('Do you Want to update?');
                            if(r==true){    
                                jQuery.ajax({
                                    type: "POST",
                                    url: server+"php/CategoryPerf_Update.php?arr="+Updated_Values,
                                    data: {
                                        'Updated_Values':Updated_Values
                                    },
                                    success: function(data){
                                        if (data) {
                                           // $('#cat_perf_updating').html('Update Failed');
                                            $('#cat_perf_updating').show();
                                        }
                                        else {
                                	   $('#cat_perf_updating').html('Update Failed'); 
                                            $('#cat_perf_updating').show();
                                        }
                                    },
                                    error:function(event){
                                        alert('error'+event.message);
                                    }
                                }); 
                            }
                        }
                        else
                        {
                            if(edit==true){
                            $('#cat_perf_err').show(); 
                            }
                            else{
                                $('#cat_perf_err').html('No Changes'); 
                                $('#cat_perf_err').show(); 
                            }
                        }
                    });
                    $("[name^=hh_perf]").each(function () {
                        $.data(this, 'default', this.value);
                    }).css("color","black")
                    .focus(function() {
                        if (!$.data(this, 'edited')) {
                            $(this).css("color","black");
                        }
                    }).change(function() {
                        $.data(this, 'edited', this.value != "");
                    }).blur(function() {
                        if ($.data(this, 'edited')) {
                            
                            $('#hh_perf_updating').hide(); 
                            edit=true;
                            value=this.value;
                            column=$(this).attr('id');
                            var name=$(this).attr('name');
                            var sb=name.substr(9,1);
                            user_val=document.getElementById("hh_perf_user_id['"+sb+"']").value;
                            index_id_val=document.getElementById("hh_perf_index_id['"+sb+"']").value;
                            if((this.value>=(-0.05))&&(this.value<=(0.05))&&(this.value!=""))
                            {
                                $(this).css("background-color","white");
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
                                    $('#hh_perf_err').hide();
                                    f=true;
                                    return true;
                                }
                                else if(col_val!=value||(col_name!=column && col_val==value)||(index_val!=index_id_val && col_val==value))
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
                                    $('#hh_perf_err').hide();
                                    f=true;
                                    return true; 
                                }
                            
                            
                            }
                    
                            else
                            {
                                $(this).css("background-color","red");
                                $('#hh_perf_err').html('Please enter value -0.05 to 0.05');
                                $('#hh_perf_err').show();
                                f=false;
                                return false;
                            }
                        } 
                        if(this.value=="")
                        {
                            $(this).css("background-color","yellow");
                            $('#hh_perf_err').html('Please enter a value');
                            $('#hh_perf_err').show();
                            f=false;
                            return false;
                        }
                    
                    });
                    
                    $('#hh_perf_save').click(function() {
                        var Updated_Values = JSON.stringify(UpValue);
                        if(f==true){
                            var r=confirm('Do you Want to update?');
                            if(r==true){   
                                jQuery.ajax({
                                    type: "POST",
                                    url: server+"php/HHPerf_Update.php?arr="+Updated_Values,
                                    data: {
                                        'Updated_Values':Updated_Values
                                    },
                                    success: function(data){
                                        if (data) {
                                           // $('#hh_perf_updating').html('Update Failed');
                                            $('#hh_perf_updating').show();
                                        }
                                        else {
                                	    $('#hh_perf_updating').html('Update Failed'); 
                                            $('#hh_perf_updating').show();
                                        }
                                    },
                                    error:function(event){
                                        alert('error'+event.message);
                                    }
                                });
                            }
                        }
                        else
                        {
                            if(edit==true){
                            $('#hh_perf_err').show();
                            }
                            else{
                                $('#hh_perf_err').html('No Changes');
                                $('#hh_perf_err').show();
                            }
                        }
                    });
                    $("[name^=guard_rails]").each(function () {
                        $.data(this, 'default', this.value);
                    }).css("color","black")
                    .focus(function() {
                        if (!$.data(this, 'edited')) {
                            $(this).css("color","black");
                        }
                    }).change(function() {
                        $.data(this, 'edited', this.value != "");
                    }).blur(function() {
                        if ($.data(this, 'edited')) {
                            
                            $('#updating').hide();
                            edit=true;
                            value=this.value;
                            column=$(this).attr('id');
                            var name=$(this).attr('name');
                            var sb=name.substr(13,1);
                            user_val=document.getElementById("guard_rails_user_id['"+sb+"']").value;
                            metric_id_value=document.getElementById("guard_rails_metric_id['"+sb+"']").value;
                            if(metric_id_value=='1'||metric_id_value=='2'){
                                if((this.value>=(30))&&(this.value<=(120))&&(this.value!=""))
                                {
                                    $(this).css("background-color","white");
                                    GuardRails_Checking(value,column,user_val,metric_id_value);
                                    
                                }
                                else if(this.value=="")
                                {
                                    $(this).css("background-color","yellow");
                                    $('#guard_rails_err').html('Please Enter Value between 30 and 120');
                                    $('#guard_rails_err').show();
                                    f=false;
                                    return false;
                                }
                                else
                                {
                                    $(this).css("background-color","red");
                                    $('#guard_rails_err').html('Please Enter Value between 30 and 120');
                                    $('#guard_rails_err').show();
                                    f=false;
                                    return false;
                                }
                            }
                            else if((metric_id_value=='3') && (column=='minimum'))
                            {
                                if((value>=(2))&&(value<=(5))&&(value!=""))
                                {
                                    $(this).css("background-color","white");
                                    GuardRails_Checking(value,column,user_val,metric_id_value);
                                }
                                else if(value=="")
                                {
                                    $(this).css("background-color","yellow");
                                    $('#guard_rails_err').html('Please Enter Minimum Value between $2 and $5 ');
                                    $('#guard_rails_err').show();
                                    f=false;
                                    return false;
                                }
                                else
                                {
                                    $(this).css("background-color","red");
                                    $('#guard_rails_err').html('Please Enter Minimum Value between $2 and $5 ');
                                    $('#guard_rails_err').show();
                                    f=false;
                                    return false;
                                } 
                                    
                            }
                            else if((metric_id_value=='3') && (column=='maximum'))
                            {
                                if((value>=(10))&&(value<=(100))&&(value!=""))
                                {
                                    $(this).css("background-color","white");
                                    GuardRails_Checking(value,column,user_val,metric_id_value);
                                }
                                else if(value=="")
                                {
                                    $(this).css("background-color","yellow");
                                    $('#guard_rails_err').html('Please Enter Minimum Value between $10 and $100');
                                    $('#guard_rails_err').show();
                                    f=false;
                                    return false;
                                }
                                else
                                {
                                    $(this).css("background-color","red");
                                    $('#guard_rails_err').html('Please Enter Minimum Value between $10 and $100 ');
                                    $('#guard_rails_err').show();
                                    f=false;
                                    return false;
                                } 
                            }
                            else if((metric_id_value=='4') && (column=='minimum'))
                            {
                                if((value>=(1))&&(value<=(2))&&(value!=""))
                                {
                                    $(this).css("background-color","white");
                                    GuardRails_Checking(value,column,user_val,metric_id_value);
                                }
                                else if(value=="")
                                {
                                    $(this).css("background-color","yellow");
                                    $('#guard_rails_err').html('Please Enter Minimum Value between $1 and $2');
                                    $('#guard_rails_err').show();
                                    f=false;
                                    return false;
                                }
                                else
                                {
                                    $(this).css("background-color","red");
                                    $('#guard_rails_err').html('Please Enter Minimum Value between $1 and $2 ');
                                    $('#guard_rails_err').show();
                                    f=false;
                                    return false;
                                }  
                            }
                            else if((metric_id_value=='4') && (column=='maximum'))
                            {
                                if((value>=(5))&&(value<=(25))&&(value!=""))
                                {
                                    $(this).css("background-color","white");
                                    GuardRails_Checking(value,column,user_val,metric_id_value);
                                }
                                else if(value=="")
                                {
                                    $(this).css("background-color","yellow");
                                    $('#guard_rails_err').html('Please Enter Maximum Value between $5 and $25');
                                    $('#guard_rails_err').show();
                                    f=false;
                                    return false;
                                }
                                else
                                {
                                    $(this).css("background-color","red");
                                    $('#guard_rails_err').html('Please Enter Maximum Value between $5 and $25 ');
                                    $('#guard_rails_err').show();
                                    f=false;
                                    return false;
                                }  
                            }
                        } 
                        if(this.value==""){
                            $(this).css("background-color","yellow");
                            $('#guard_rails_err').html('Please Enter Value ');
                            $('#guard_rails_err').show();
                            f=false;
                            return false; 
                        }
                    
                    });
                    
                    $('#guard_rails_save').click(function() {
                        var Updated_Values = JSON.stringify(UpValue);
                        if(f==true){
                            var r=confirm('Do you Want to update?');
                            if(r==true){  
                                jQuery.ajax({
                                    type: "POST",
                                    url: server+"php/GuardRails_Update.php?arr="+Updated_Values,
                                    data: {
                                        'Updated_Values':Updated_Values
                                    },
                    
                                    success: function(data){
                                        if (data) {
                                           // $('#updating').html('Update Failed');
                                            $('#updating').show();
                                        }
                                        else {
                                	    $('#updating').html('Update Failed'); 
                                            $('#updating').show();
                                        }
                                    },
                                    error:function(event){
                                        alert('error'+event.message);
                                    }
                                }); 
                            }
                        }
                        else
                        {
                            if(edit==true){
                            $('#guard_rails_err').show();
                            }
                            else{
                               $('#guard_rails_err').html('No Changes'); 
                               $('#guard_rails_err').show();
                            }
                        }
                    });
                
                    $("[name^=val_con]").each(function () {
                        $.data(this, 'default', this.value);
                    }).css("color","black")
                    .focus(function() {
                        if (!$.data(this, 'edited')) {
                            $(this).css("color","black");
                        }
                    }).change(function() {
                        $.data(this, 'edited', this.value != "");
                    }).blur(function() {
                        if ($.data(this, 'edited')) {

                                $('#updating').hide();
                                edit=true;
                                value=this.value;
                                column=$(this).attr('id');
                                var name=$(this).attr('name');
                                var sb=name.substr(9,1);
                                user_val=document.getElementById("val_control_user_id['"+sb+"']").value;
                                metric_id_value=document.getElementById("val_control_metric_id['"+sb+"']").value;
                                if((metric_id_value=='1')&&((column=='minimum'))){
                                    if((value>=(0))&&(value<=(120))&&(value!=""))
                                    {
                                        $(this).css("background-color","white");
                                        GuardRails_Checking(value,column,user_val,metric_id_value);
                                    
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Please enter a value');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    }
                                    else
                                    {
                                        $(this).css("background-color","red");
                                        $('#Val_control_err').html('Please Enter Value between 0 and 120');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    }
                                }
                                else if((metric_id_value=='1')&&((column=='maximum')))
                                {
                                    if((value>=(0))&&(value<=(120))&&(value!=""))
                                    {
                                        $(this).css("background-color","white");
                                        GuardRails_Checking(value,column,user_val,metric_id_value);
                                    
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Please enter a value');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    }
                                    else
                                    {
                                        $(this).css("background-color","red");
                                        $('#Val_control_err').html('Please Enter Value between 0 and 120');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    }
                                }
                                else if((metric_id_value=='2'))
                                {
                                    if((value>=(10))&&(value<=(120))&&(value!=""))
                                    {
                                        $(this).css("background-color","white");
                                        GuardRails_Checking(value,column,user_val,metric_id_value);
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Please enter a value');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    }
                                    else
                                    {
                                        $(this).css("background-color","red");
                                        $('#Val_control_err').html('Please Enter Value between 10 and 120 ');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    } 
                                    
                                }
                                else if((metric_id_value=='3'))
                                {
                                    if((value>=(1))&&(value<=(30))&&(value!=""))
                                    {
                                        $(this).css("background-color","white");
                                        GuardRails_Checking(value,column,user_val,metric_id_value);
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Please enter a value');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    }
                                    else
                                    {
                                        $(this).css("background-color","red");
                                        $('#Val_control_err').html('Please Enter Value between 1 and 30 ');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    } 
                                    
                                }
                                else if((metric_id_value=='4'))
                                {
                                    if((value>=(30))&&(value<=(100))&&(value!=""))
                                    {
                                        $(this).css("background-color","white");
                                        GuardRails_Checking(value,column,user_val,metric_id_value);
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Please enter a value');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    }
                                    else
                                    {
                                        $(this).css("background-color","red");
                                        $('#Val_control_err').html('Please Enter Value between 30 and 100 ');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    } 
                                }
                                else if((metric_id_value=='5'))
                                {
                                    if((value>=(5))&&(value<=(120))&&(value!=""))
                                    {
                                        $(this).css("background-color","white");
                                        GuardRails_Checking(value,column,user_val,metric_id_value);
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Please enter a value');
                                        $('#Val_control_err').show();
                                        return false;
                                    }
                                    else
                                    {
                                        $(this).css("background-color","red");
                                        $('#Val_control_err').html('Please Enter Value between 5 and 120 ');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    } 
                                }
                                else if((metric_id_value=='6'))
                                {
                                    if((value>=(30))&&(value<=(120))&&(value!=""))
                                    {
                                        $(this).css("background-color","white");
                                        GuardRails_Checking(value,column,user_val,metric_id_value);
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Please enter a value');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    }
                                    else
                                    {
                                        $(this).css("background-color","red");
                                        $('#Val_control_err').html('Please Enter Value between 30 and 120 ');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    }  
                                }
                                else if((metric_id_value=='7'))
                                {
                                    if((value>=(30))&&(value<=(50))&&(value!=""))
                                    {
                                        $(this).css("background-color","white");
                                        GuardRails_Checking(value,column,user_val,metric_id_value);
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Please enter a value');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    }
                                    else
                                    {
                                        $(this).css("background-color","red");
                                        $('#Val_control_err').html('Please Enter  Value between 30 and 50 ');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    }  
                                }
                                else if((metric_id_value=='8'))
                                {
                                    if((value>=(5))&&(value<=(100))&&(value!=""))
                                    {
                                        $(this).css("background-color","white");
                                        GuardRails_Checking(value,column,user_val,metric_id_value);
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Please enter a value');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    }
                                    else
                                    {
                                        $(this).css("background-color","red");
                                        $('#Val_control_err').html('Please Enter Value between 5 and 100 ');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    }  
                                }
                                else if((metric_id_value=='9'))
                                {
                                    if((value>=(1))&&(value<=(25))&&(value!=""))
                                    {
                                        $(this).css("background-color","white");
                                        GuardRails_Checking(value,column,user_val,metric_id_value);
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Please enter a value');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    }
                                    else
                                    {
                                        $(this).css("background-color","red");
                                        $('#Val_control_err').html('Please Enter Value between 1 and 25 ');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    }  
                                }
                        }
                        if(this.value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Please enter a value');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    }

                    });

                    $('#val_control_save').click(function() {
                        var Updated_Values = JSON.stringify(UpValue);
                        if(f==true){
                            var r=confirm('Do you Want to update?');
                            if(r==true){  
                          jQuery.ajax({
                            type: "POST",
                            url: server+"php/ValControls_Update.php?arr="+Updated_Values,
                            data: {
                                'Updated_Values':Updated_Values
                            },
                            success: function(data){
                                if (data) {
                                    //$('#updating').html('Update Failed');
                                    $('#updating').show();
                                }
                                else {
				$('#updating').html('Update Failed');
				$('#updating').show();
                                }
                            },
                            error:function(event){
                                alert('error'+event.message);
                            }
                          });
                          }
                        }
                        else
                        {
                            if(edit==true){
                              $('#Val_control_err').show(); 
                            }
                            else{
                                $('#Val_control_err').html("No Changes");
                                $('#Val_control_err').show();
                            }
                        }
                    });
              
                    $("[name^=pgm_param]").each(function () {
                      $.data(this, 'default', this.value);
                    }).css("color","black")
                    .focus(function() {
                        if (!$.data(this, 'edited')) {
                            $(this).css("color","black");
                        }
                    }).change(function() {
                        $.data(this, 'edited', this.value != "");
                    }).blur(function() {
                        if ($.data(this, 'edited')) {

                                $('#pgm_param_updating').hide();
                                edit=true;
                                value=this.value;
                                column=$(this).attr('id');
                                var name=$(this).attr('name');
                                var sb=name.substr(11,1);
                                user_val=document.getElementById("pgm_param_user_id['"+sb+"']").value;
                                parameters=document.getElementById("pgm_parameter['"+sb+"']").value;
                                parameter=document.getElementById("pgm_parameter_id['"+sb+"']").value;
                                //parameters=parameters.toUpperCase();
                                if(parameter=='1'){
                                    if((value>=1)&&(value<=10)&&(value!=""))
                                    {
                                        $(this).css("background-color","white");f=true;
                                        GuardRails_Checking(value,column,user_val,parameter);
                                    
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#pgm_param_err').html('Please enter a value');
                                        $('#pgm_param_err').show();
                                        f=false;
                                        return false;
                                    }
                                    else
                                    {
                                        $(this).css("background-color","red");
                                        $('#pgm_param_err').html('Please Enter Value between 1 and 10');
                                        $('#pgm_param_err').show();
                                        f=false;
                                        return false;
                                    }
                                }
                                else if((parameter=='2'))
                                {
                                    if((value>=(1))&&(value<=(5))&&(value!=""))
                                    {
                                        $(this).css("background-color","white");
                                        GuardRails_Checking(value,column,user_val,parameter);
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#pgm_param_err').html('Please enter a value');
                                        $('#pgm_param_err').show();
                                        f=false;
                                        return false;
                                    }
                                    else
                                    {
                                        $(this).css("background-color","red");
                                        $('#pgm_param_err').html('Please Enter Value between 1 and 5 ');
                                        $('#pgm_param_err').show();
                                        f=false;
                                        return false;
                                    } 
                                    
                                }
                                else if((parameter=='3'))
                                {
                                    if((value>=(1))&&(value<=(5))&&(value!=""))
                                    {
                                        $(this).css("background-color","white");
                                        GuardRails_Checking(value,column,user_val,parameter);
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#pgm_param_err').html('Please enter a value');
                                        $('#pgm_param_err').show();
                                        f=false;
                                        return false;
                                    }
                                    else
                                    {
                                        $(this).css("background-color","red");
                                        $('#pgm_param_err').html('Please Enter Value between $1 and $5 ');
                                        $('#pgm_param_err').show();
                                        f=false;
                                        return false;
                                    } 
                                    
                                }
                                else if((parameter=='4'))
                                {
                                    if((value>=(5))&&(value<=(7))&&(value!=""))
                                    {
                                        $(this).css("background-color","white");
                                        GuardRails_Checking(value,column,user_val,parameter);
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#pgm_param_err').html('Please enter a value');
                                        $('#pgm_param_err').show();
                                        f=false;
                                        return false;
                                    }
                                    else
                                    {
                                        $(this).css("background-color","red");
                                        $('#pgm_param_err').html('Please Enter Value between $5 and $7 ');
                                        $('#pgm_param_err').show();
                                        f=false;
                                        return false;
                                    } 
                                }
                                else if((parameter=='5'))
                                {
                                    if((value==('YES'))||(value==('NO')||(value=='yes')||(value=='no'))&&(value!=""))
                                    {
                                        $(this).css("background-color","white");
                                        GuardRails_Checking(value,column,user_val,parameter);
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#pgm_param_err').html('Please enter a value');
                                        $('#pgm_param_err').show();
                                        f=false;
                                        return false;
                                    }
                                    else
                                    {
                                        $(this).css("background-color","red");
                                        $('#pgm_param_err').html('Please Enter Value YES/NO ');
                                        $('#pgm_param_err').show();
                                        return false;
                                    } 
                                }
                                else if((parameter=='6'))
                                {
                                    if((value>=(1))&&(value<=(5))&&(value!=""))
                                    {
                                        $(this).css("background-color","white");
                                        GuardRails_Checking(value,column,user_val,parameter);
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#pgm_param_err').html('Please enter a value');
                                        $('#pgm_param_err').show();
                                        f=false;
                                        return false;
                                    }
                                    else
                                    {
                                        $(this).css("background-color","red");
                                        $('#pgm_param_err').html('Please Enter Value between 1 and 5 ');
                                        $('#pgm_param_err').show();
                                        f=false;
                                        return false;
                                    }  
                                }
                                else if((parameter=='7'))
                                {
                                    if(((value=="YES")||(value=="NO")||(value=="yes")||(value=="no"))&&(value!=""))
                                    {
                                        $(this).css("background-color","white");
                                        GuardRails_Checking(value,column,user_val,parameter);
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#pgm_param_err').html('Please enter a value');
                                        $('#pgm_param_err').show();
                                        f=false;
                                        return false;
                                    }
                                    else
                                    {
                                        $(this).css("background-color","red");
                                        $('#pgm_param_err').html('Please Enter Value YES/NO ');
                                        $('#pgm_param_err').show();
                                        f=false;
                                        return false;
                                    }  
                                }
                            }
                          if(this.value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#pgm_param_err').html('Please enter a value');
                                        $('#pgm_param_err').show();
                                        f=false;
                                        return false;
                                    }

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
                        if(f==true){
                            var r=confirm('Do you Want to update?');
                            if(r==true){ 
                        jQuery.ajax({
                            type: "POST",
                            url: server+"php/ProgramParameter_Update.php?arr="+Updated_Values,
                            data: {
                                'Updated_Values':Updated_Values
                            },
                            success: function(data){
                                if (data) {
                                   // $('#pgm_param_updating').html('Update Failed');
                                    $('#pgm_param_updating').show();
                                }
                                else {
                                    $('#pgm_param_updating').html('Update Failed'); 
                                    $('#pgm_param_updating').show();
                                }
                            },
                            error:function(event){
                                alert('error'+event.message);
                            }
                        });
                      } 
                    }
                    else
                    {
                        if(edit==true){
                          $('#pgm_param_err').show(); 
                        }
                        else{
                            $('#pgm_param_err').html('No Changes'); 
                            $('#pgm_param_err').show(); 
                        }
                    }
                    });
                
                    $('#drp_dwn_super_category').live('change', function(e) {
                        desc=(e.target.options[e.target.selectedIndex].text);
                        val=(e.target.options[e.target.selectedIndex].value);
                        user_val=document.getElementById("username").value;
                        $.post(server+'php/EligibleProduct.php?sup_id='+val, {
                            "sup_id": val
                        }, function (txt) {
                                
                            $('#sample').html(txt);
                            $('#sample #prheading').hide();
			    $('#sample #headings').hide();
			    $('#sample .mainmenu').hide();
			    $('#sample #logout').hide();
			    $('#sample #logo').hide();
			    $('#sample #mainmenubg').hide();
			    $('#sample #bottomstripe').hide();
                            $('#sample #drp_dwn_super_category').hide();
                            $('#sample #super').hide();
                            $('#sample .prod_cat_updating').hide();
                            $('.prod_cat_updating').hide();
                            $('#sample #pro_cat_save').hide();
                            $('#sample #prod_cat_ancel').hide();
                            $('#prod_cat_err').hide();
                                  
                        });
                    });
                    
/*                    $("[name^=prod_cat]").each(function () {
                        $.data(this, 'default', this.value);
                    }).css("color","black")
                    .focus(function() {
                        if (!$.data(this, 'edited')) {
                            $(this).css("color","black");
                        }
                    }).change(function() {
                        $.data(this, 'edited', this.value != "");
                    }).blur(function() {
                        if ($.data(this, 'edited')) {

                                $('.prod_cat_updating').hide();
                                $('#sample .prod_cat_updating').hide();
                                edit=true;
                                value=this.value;
                                column=$(this).attr('id');
                                var name=$(this).attr('name');
                                var sb=name.substr(9,1);
                                user_val=document.getElementById("prod_cat_user_id["+sb+"]").value;
                                super_cat_code=document.getElementById("super_cat_code["+sb+"]").value;
                                super_cat_id=document.getElementById("super_cat_id["+sb+"]").value;
                                if(((value=='YES')||(value=='NO')||(value=='yes')||(value=='no')||value=='Yes'||(value=='No'))&&(value!=""))
                                {
                                    $(this).css("background-color","white");
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
                                        $('#prod_cat_err').hide();
                                        f=true;
                                        return true;
                                    }
                                    else if(col_val!=value||(category_code!=super_cat_code&&col_val==value))
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
                                        $('#prod_cat_err').hide();
                                        f=true;
                                        return true; 
                                    }
//                            
                                    $('#prod_cat_err').hide();
                                    return true; 
                                }
                                else if(value=="")
                                {
                                    $(this).css("background-color","yellow");
                                    $('.prod_cat_updating').hide();
                                    $('#sample .prod_cat_updating').hide();
                                    $('#prod_cat_err').html('Please enter a value');
                                    $('#prod_cat_err').show();
                                    f=false;
                                    return false;
                                }
                                else
                                {
                                    $(this).css("background-color","red");
                                    $('.prod_cat_updating').hide();
                                    $('#sample .prod_cat_updating').hide();
                                    $('#prod_cat_err').html('Please enter  value YES/NO');
                                    $('#prod_cat_err').show();
                                    f=false;
                                    return false;
                                }
                        }
                        if(this.value=="")
                                {
                                    $(this).css("background-color","yellow");
                                    $('.prod_cat_updating').hide();
                                    $('#sample .prod_cat_updating').hide();
                                    $('#prod_cat_err').html('Please enter a value YES/NO');
                                    $('#prod_cat_err').show();
                                    f=false;
                                    return false;
                                }
                            

                    }); 
                    
      		   $("[name^=prod_cat1]").each(function () {
                     $('[name^=prod_cat1]').live('change', function(e) {
                      var val=(e.target.options[e.target.selectedIndex].text);
                       $('.prod_cat_updating').hide();
                        $('#sample .prod_cat_updating').hide();
                        edit=true;
                        column=$(this).attr('id');
                                var name=$(this).attr('name');
                                var sb=name.substr(10,1);
                                user_val=document.getElementById("prod_cat_user_id["+sb+"]").value;
                                super_cat_code=document.getElementById("super_cat_code["+sb+"]").value;
                                super_cat_id=document.getElementById("super_cat_id["+sb+"]").value;
                                //alert(column);
                                 if(col_val=="")
                                    {
                                        col_val=val;
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
                                    
                                        UpValue.push(UP_Value);f=true;
                                        $('#prod_cat_err').hide();
                                        
                                        return true;
                                    }
                                    else if(col_val!=val||(category_code!=super_cat_code&&col_val==val))
                                    {
                                        col_val=val;
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
                                    
                                        UpValue.push(UP_Value);f=true;
                                        $('#prod_cat_err').hide();
                                        
                                        return true; 
                                    }
                   	 });
                  
                  	});*/ 
                     
                    $('#pro_cat_save').click(function() {
			$("input[type=checkbox]:checked").each ( function() {
                            //alert ( $(this).val() );
                                edit=true;
                                value=$(this).val();
                                column=$(this).attr('id');
                                var name=$(this).attr('name');
                                var sb=name.substr(7,1);
                                user_val=document.getElementById("prod_cat_user_id["+sb+"]").value;
                                super_cat_code=document.getElementById("super_cat_code["+sb+"]").value;
                                super_cat_id=document.getElementById("super_cat_id["+sb+"]").value;
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
                                        $('#prod_cat_err').hide();
                                        f=true;
                                        return true;
                                    }
                                    else if(col_val!=value||(category_code!=super_cat_code&&col_val==value))
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
                                        $('#prod_cat_err').hide();
                                        f=true;
                                        return true; 
                                    }
//                            
                                    $('#prod_cat_err').hide();
                                    return true;
                    });
                        var Updated_Values = JSON.stringify(UpValue);
                        if(f==true){
                          var r=confirm('Do you Want to Update?')
                          if(r==true){
                            jQuery.ajax({
                                type: "POST",
                                url: server+"php/EligibleProducts_Update.php?arr="+Updated_Values,
                                data: {
                                    'Updated_Values':Updated_Values
                                },
                                success: function(data){
                                    if (data) {
                                       
                                        $('.prod_cat_updating').show();
					$('#sample .prod_cat_updating').hide();
                                 
                                    }
                                    else {
                                        $('.prod_cat_updating').html('Update Failed ');
                                        $('.prod_cat_updating').show();
                                        $('#sample .prod_cat_updating').hide();
                                 
                                    }
                                },
                                error:function(event){
                                    alert('error'+event.message);
                                }
                            });  
                         }
                        }
                        else
                        {
                            if(edit==true)   {
                               $('.prod_cat_updating').hide();
                                    $('#sample .prod_cat_updating').hide();
                                    $('#prod_cat_err').html('Please check a value YES/NO');
                                    $('#prod_cat_err').show(); 
                            } 
                            else{
                                $('.prod_cat_updating').hide();
                                    $('#sample .prod_cat_updating').hide();
                                    $('#prod_cat_err').html('No Changes');
                                    $('#prod_cat_err').show();
                            }
                        }
                    });

           
            
               
            });     
        });
    });
});
