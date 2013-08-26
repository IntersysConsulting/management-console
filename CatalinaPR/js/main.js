var min_length=8;
var unamemaxlength=20;
var passmaxlength=15;
var server = "http://stptmpplnxv01:8080/";
var value,column,user_val,user_id_col,seg_id,segment_id_val,metric_id_value,super_cat_code,category_code;
var col_val,col_name,user_id_val,seg_id_val,index_id_val,index_val,metric_val,val,super_cat_id;
var timeout=25000;
var minimumval=[]; 
var UpValue = [];
var i=0,f=false,edit=false;
var k=0;
var cnt=0,l4_cnt=0;
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

include(server + 'js/jquery-1.7.1.min.js', function() {
    include(server + 'js/jquery-ui.js', function() {
		jQuery(window).load(function() {
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
                });
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
                    $('#supers').hide();
                     //$('#sample #supers').hide();
                    
                    jQuery('#submit').click(function () {
                        var uname=document.getElementById("userid").value;
                        var passwrd=document.getElementById("passwrd").value;
                        if(uname.length >= min_length && uname.length <= unamemaxlength && passwrd.length >= min_length && passwrd.length <= passmaxlength)  
                        {   
                  

                            return true;      
                        }  
                        else if((passwrd.length >= min_length && passwrd.length <= passmaxlength) && uname.length <= min_length || uname.length >= unamemaxlength  ) 
                        {       
                            $('#userid_error').html('Please Enter user_id between 8 and 20 characters');
                            $('#userid_error').show();
                            document.getElementById("userid_error").focus();
                            return false;     
                        } 
                        else if((passwrd.length <= min_length || passwrd.length >= passmaxlength) && uname.length >= min_length && uname.length <= unamemaxlength)  
                        {       
                            $('#passwrd_error').html('Please input password between 8 and 15 characters');
                            $('#passwrd_error').show();
                            document.getElementById("passwrd_error").focus();
                            return false;     
                        }  
                        else  
                        {       
                            $('#userid_error').html('Please Enter user_id between 8 and 20 characters');
                            $('#passwrd_error').html('Please input password between 8 and 15 characters');
                            $('#userid_error').show();
                            $('#passwrd_error').show();
                            document.getElementById("userid_error").focus();
                            return false;     
                        } 
                    });
                    //if(document.URL=='http://localhost:8080/CatalinaPR/management-console/CatalinaPR/index.php?err=aInsufficient%20Privileges%20or%20unable%20to%20authenticate,please%20contact%20xxxx%20for%20further%20assistance')
                    if(document.URL=='http://stptmpplnxv01:8080/index.php?err=You%20are%20not%20authorized%20to%20access%20the%20application,please%20contact%20support%20for%20assistance')
                        {
                          jQuery('#submit').click(function () {
                        var uname=document.getElementById("userid").value;
                        var passwrd=document.getElementById("passwrd").value;
                        if(uname.length >= min_length && uname.length <= unamemaxlength && passwrd.length >= min_length && passwrd.length <= passmaxlength)  
                        {   
                            return true;      
                        }  
                        else if((passwrd.length >= min_length && passwrd.length <= passmaxlength) && uname.length <= min_length || uname.length >= unamemaxlength  ) 
                        {       
                            $('#userid_error').html('Please Enter user_id between 8 and 20 characters');
                            $('#userid_error').show();
                            document.getElementById("userid_error").focus();
                            return false;     
                        } 
                        else if((passwrd.length <= min_length || passwrd.length >= passmaxlength) && uname.length >= min_length && uname.length <= unamemaxlength)  
                        {       
                            $('#passwrd_error').html('Please input password between 8 and 15 characters');
                            $('#passwrd_error').show();
                            document.getElementById("passwrd_error").focus();
                            return false;     
                        }  
                        else  
                        {       
                            $('#userid_error').html('Please Enter user_id between 8 and 20 characters');
                            $('#passwrd_error').html('Please input password between 8 and 15 characters');
                            $('#userid_error').show();
                            $('#passwrd_error').show();
                            document.getElementById("userid_error").focus();
                            return false;     
                        } 
                    });  
                        }
                        
                    jQuery('#login_cancel').click(function () {
                        document.getElementById("userid").value="";
                        document.getElementById("passwrd").value=""; 
                        $('#error').hide();
                        $('#userid_error').hide();
                        $('#passwrd_error').hide();
                        document.getElementById("userid_error").focus();
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
                                //if(this.value.toPrecision){$(this).val(this.value.toPrecision(2));}
                                var decimal=  /^[-+]?[0-9]+\.[0-9]+$/;   
                                if(value.match(decimal))   
                                {   
                                }  
                                else  
                                { if(value==0){$(this).val(value); }
                                  else if(value>0){ $(this).val('0'+value);  }
                                  else{var valsplit=value.toString().split("-")
                                      $(this).val('-0'+valsplit[1]);}
                                }   

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
                        var sales_each=0,sales_range=0,not_range_sales=0;
                         $("[name^=inp_text]").each(function () {
                             sales_each++;
                             var values=this.value;
                             if((this.value>=(-0.10))&&(this.value<=(0.20))&&(this.value!="")){
                                 sales_range++;
                             }
                             else{
                                   not_range_sales++;
                            }
                        });                     
                        var Updated_Values = JSON.stringify(UpValue);
                        if(f==true && sales_range==sales_each && not_range_sales==0 ){
                            if(k==0){
                           var conbox=confirm('Are you sure you want to update this value?');}
                            
                         if(conbox==true){
                              jQuery.ajax({
                                    type: "POST",
                                    url: server+"php/SalesChange_Update.php?arr="+Updated_Values,
                                    data: {
                                        'Updated_Values':Updated_Values
                                    },
                                    success: function(data){
                                        if((typeof data == 'string' || data instanceof String)&& data.length>3) {
                                            $('#updating').html(data);
                                            $('#updating').show();
                                        }
                                        else if(data.length<=4){
                                            $('#updating').html('Your updates were saved');
                                            $('#updating').show(); 
                                       }
                                       else{
                                           $('#updating').html('Update Failed');
                                           $('#updating').show();     
                                       }
                                    },
                                    error:function(event){
                                        alert('error'+event.message);
                                    }
                                });
                                if($.browser.version=='9.0'){
                                k++;}
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
                            if((this.value>=(0))&&(this.value<=(1))&&(this.value!=""))
                            {
                                var decimal=  /^[-+]?[0-9]+\.[0-9]+$/;   
                                if(value.match(decimal))   
                                {   
                                }  
                                else  
                                { if(value==0 || value==1){$(this).val(value); }
                                  else{$(this).val('0'+value); }
                                }  
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
                                $('#roi_goals_err').html('Please enter value between 0 to 1');
                                $('#roi_goals_err').show();
                                f=false;
                                return false;
                            }
                        }
                        if(this.value=="")
                        {
                            $(this).css("background-color","yellow");
                            $('#roi_goals_err').html('Please enter a value between 0 to 1');
                            $('#roi_goals_err').show();
                            f=false;
                            return false;
                        }
                       
                    
                    });
                    
                    $('#ROI_Goals_save').click(function() {
                         var goals_each=0,goals_range=0,not_range_goals=0; 
                         $("[name^=roi_goals]").each(function () {
                             goals_each++;
                             var values=this.value;
                             if((this.value>=(0))&&(this.value<=(1))&&(this.value!="")){
                                  goals_range++;
                             }
                             else{
                                   not_range_goals++;
                             }
                         });        
                        var Updated_Values = JSON.stringify(UpValue);
                        if(f==true && goals_each==goals_range && not_range_goals==0){
                            
                           if(k==0){ var r=confirm('Are you sure you want to update this value?');}
                            
                            if(r==true){
                                jQuery.ajax({
                                    type: "POST",
                                    url: server+"php/ROIGoals_Update.php?arr="+Updated_Values,
                                    data: {
                                        'Updated_Values':Updated_Values
                                    },
                                    success: function(data){
                                        if((typeof data == 'string' || data instanceof String)&& data.length>3) {
                                            $('#roi_goal_updating').html(data);
                                            $('#roi_goal_updating').show();
                                        }
                                        else if(data.length<=4){
                                            $('#roi_goal_updating').html('Your updates were saved');
                                            $('#roi_goal_updating').show(); 
                                       }
                                       else{
                                           $('#roi_goal_updating').html('Update Failed');
                                           $('#roi_goal_updating').show();     
                                       }
                                    },
                                    error:function(event){
                                        alert('error'+event.message);
                                    }
                                });
                                if($.browser.version=='9.0'){
                                k++;}
                            }
                        }
                        else
                        {
                            if(edit==true){
                                $('#roi_goals_err').html('Please enter value between 0 to 1');
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
                                var decimal=  /^[-+]?[0-9]+\.[0-9]+$/;   
                                if(value.match(decimal))   
                                {   
                                }  
                                else  
                                { if(value==0){$(this).val(value); }
                                  else{ $(this).val('0'+value);  }
                                } 
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
                        var adj_each=0,adj_range=0,not_range_adj=0; 
                         $("[name^=roi_adj]").each(function () {
                             adj_each++;
                             var values=this.value;
                             if((this.value>=(0))&&(this.value<=(0.20))&&(this.value!="")){
                                  adj_range++;
                             }
                             else{
                                   not_range_adj++;
                             }
                        });  
                        var Updated_Values = JSON.stringify(UpValue);
                        if(f==true && adj_each==adj_range && not_range_adj==0){
                           if(k==0){ var r=confirm('Are you sure you want to update this value?');}
                            if(r==true){
                                jQuery.ajax({
                                    type: "POST",
                                    url: server+"php/ROIAdj_Update.php?arr="+Updated_Values,
                                    data: {
                                        'Updated_Values':Updated_Values
                                    },
                                    success: function(data){
                                        if((typeof data == 'string' || data instanceof String)&& data.length>3) {
                                            $('#roi_adj_updating').html(data);
                                            $('#roi_adj_updating').show();
                                        }
                                        else if(data.length<=4){
                                            $('#roi_adj_updating').html('Your updates were saved');
                                            $('#roi_adj_updating').show(); 
                                       }
                                       else{
                                           $('#roi_adj_updating').html('Update Failed');
                                           $('#roi_adj_updating').show();     
                                       }
                                    },
                                    error:function(event){
                                        alert('error'+event.message);
                                    }
                                }); 
                                if($.browser.version=='9.0'){
                                k++;}
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
                        var purch_each=0,purch_range=0,not_range_purch=0; 
                         $("[name^=pur_cyc]").each(function () {
                             purch_each++;
                             var values=this.value;
                             if((this.value>=(30))&&(this.value<=(100))&&(this.value!="")){
                                  purch_range++;
                             }
                             else{
                                   not_range_purch++;
                             }
                        });        
                        var Updated_Values = JSON.stringify(UpValue);
                        if(f==true && purch_each==purch_range && not_range_purch==0){
                           if(k==0){ var r=confirm('Are you sure you want to update this value?');}
                            if(r==true){
                                jQuery.ajax({
                                    type: "POST",
                                    url: server+"php/PurchaseCycle_Update.php?arr="+Updated_Values,
                                    data: {
                                        'Updated_Values':Updated_Values
                                    },
                    
                                    success: function(data){
                                        if((typeof data == 'string' || data instanceof String)&& data.length>3) {
                                            $('#pur_cyc_updating').html(data);
                                            $('#pur_cyc_updating').show();
                                        }
                                        else if(data.length<=4){
                                            $('#pur_cyc_updating').html('Your updates were saved');
                                            $('#pur_cyc_updating').show(); 
                                       }
                                       else{
                                           $('#pur_cyc_updating').html('Update Failed');
                                           $('#pur_cyc_updating').show();     
                                       }
                                    },
                                    error:function(event){
                                        alert('error'+event.message);
                                    }
                                });
                                if($.browser.version=='9.0'){
                                k++;}
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
                            if((this.value>=(-0.05))&&(this.value<=(0.05))&&(this.value!=""))
                            {
                                var decimal=  /^[-+]?[0-9]+\.[0-9]+$/;   
                                if(value.match(decimal))   
                                {   
                                }  
                                else  
                                { if(value==0){$(this).val(value); }
                                  else if(value>0){ $(this).val('0'+value);  }
                                  else{var valsplit=value.toString().split("-")
                                      $(this).val('-0'+valsplit[1]);}
                                } 
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
                                $('#cat_perf_err').html('Please enter value between -0.05 to 0.05');
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
                        var categ_each=0,categ_range=0,not_range_categ=0; 
                         $("[name^=cat_per]").each(function () {
                             categ_each++;
                             var values=this.value;
                             if((this.value>=(-0.05))&&(this.value<=(0.05))&&(this.value!="")){
                                  categ_range++;
                             }
                             else{
                                   not_range_categ++;
                             }
                        });        
                        var Updated_Values = JSON.stringify(UpValue);
                        if(f==true && categ_each==categ_range && not_range_categ==0){
                           if(k==0){ var r=confirm('Are you sure you want to update this value?');}
                            if(r==true){    
                                jQuery.ajax({
                                    type: "POST",
                                    url: server+"php/CategoryPerf_Update.php?arr="+Updated_Values,
                                    data: {
                                        'Updated_Values':Updated_Values
                                    },
                                    success: function(data){
                                        if((typeof data == 'string' || data instanceof String)&& data.length>3) {
                                            $('#cat_perf_updating').html(data);
                                            $('#cat_perf_updating').show();
                                        }
                                        else if(data.length<=4){
                                            $('#cat_perf_updating').html('Your updates were saved');
                                            $('#cat_perf_updating').show(); 
                                       }
                                       else{
                                           $('#cat_perf_updating').html('Update Failed');
                                           $('#cat_perf_updating').show();     
                                       }
                                    },
                                    error:function(event){
                                        alert('error'+event.message);
                                    }
                                }); 
                                if($.browser.version=='9.0'){
                                k++;}
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
                                var decimal=  /^[-+]?[0-9]+\.[0-9]+$/;   
                                if(value.match(decimal))   
                                {   
                                }  
                                else  
                                { if(value==0){$(this).val(value); }
                                  else if(value>0){ $(this).val('0'+value);  }
                                  else{var valsplit=value.toString().split("-")
                                      $(this).val('-0'+valsplit[1]);}
                                } 
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
                        var hh_each=0,hh_range=0,not_range_hh=0; 
                         $("[name^=hh_perf]").each(function () {
                             hh_each++;
                             var values=this.value;
                             if((this.value>=(-0.05))&&(this.value<=(0.05))&&(this.value!="")){
                                  hh_range++;
                             }
                             else{
                                   not_range_hh++;
                             }
                        });
                        var Updated_Values = JSON.stringify(UpValue);
                        if(f==true && hh_each==hh_range && not_range_hh==0){
                            if(k==0){var r=confirm('Are you sure you want to update this value?');}
                            if(r==true){   
                                jQuery.ajax({
                                    type: "POST",
                                    url: server+"php/HHPerf_Update.php?arr="+Updated_Values,
                                    data: {
                                        'Updated_Values':Updated_Values
                                    },
                                    success: function(data){
                                        if((typeof data == 'string' || data instanceof String)&& data.length>3) {
                                            $('#hh_perf_updating').html(data);
                                            $('#hh_perf_updating').show();
                                        }
                                        else if(data.length<=4){
                                            $('#hh_perf_updating').html('Your updates were saved');
                                            $('#hh_perf_updating').show(); 
                                       }
                                       else{
                                           $('#hh_perf_updating').html('Update Failed');
                                           $('#hh_perf_updating').show();     
                                       }
                                    },
                                    error:function(event){
                                        alert('error'+event.message);
                                    }
                                });
                                if($.browser.version=='9.0'){
                                k++;}
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
                            if(((metric_id_value=='1')) &&(column=='minimum')) {
                                maxval1=document.getElementsByName("guard_rails['0']")[1].value;
                                if((this.value>=(30))&&(this.value<=(120))&&(this.value!=""))
                                {
                                    if(this.value<=parseInt(maxval1)){
                                    $(this).css("background-color","white");
                                    GuardRails_Checking(value,column,user_val,metric_id_value);
                                    }
                                    else{
                                      $(this).css("background-color","yellow");
                                    $('#guard_rails_err').html('Minimum value exceeds maximum value for Program Duration (Seasonal Category)');
                                    $('#guard_rails_err').show();
                                    f=false;
                                    return false;  
                                    }
                                    
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
                           else if((metric_id_value=='2') &&(column=='minimum')) {
                                maxval2=document.getElementsByName("guard_rails['1']")[1].value;
                                if((this.value>=(30))&&(this.value<=(120))&&(this.value!=""))
                                {
                                    if(value<=parseInt(maxval2)){
                                    $(this).css("background-color","white");
                                    GuardRails_Checking(value,column,user_val,metric_id_value);
                                    }
                                    else{
                                      $(this).css("background-color","yellow");
                                    $('#guard_rails_err').html('Minimum value exceeds maximum value for Program Duration (Seasonal Category)');
                                    $('#guard_rails_err').show();
                                    f=false;
                                    return false;  
                                    }
                                    
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
                            else if((metric_id_value=='1') && (column=='maximum'))
                            {
                                minimumval1=document.getElementsByName("guard_rails['0']")[0].value;
                               if((this.value>=(30))&&(this.value<=(120))&&(this.value!=""))
                                {
                                   if(this.value>=parseInt(minimumval1)){
                                      $(this).css("background-color","white");
                                     GuardRails_Checking(value,column,user_val,metric_id_value);
                                   }
                                   else
                                   {
                                      $(this).css("background-color","yellow");
                                      $('#guard_rails_err').html('Maximum value is less than minimum value for Program Duration (Seasonal Category)');
                                      $('#guard_rails_err').show();
                                      f=false;
                                      return false; 
                                   }
                                    
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
                            else if((metric_id_value=='2') && (column=='maximum'))
                            {
                                minimumval2=document.getElementsByName("guard_rails['1']")[0].value;
                               if((this.value>=(30))&&(this.value<=(120))&&(this.value!=""))
                                {
                                    if(value>=parseInt(minimumval2)){
                                      $(this).css("background-color","white");
                                      GuardRails_Checking(value,column,user_val,metric_id_value);
                                    }
                                    else
                                    {
                                       $(this).css("background-color","yellow");
                                       $('#guard_rails_err').html('Maximum value is less than minimum value for Program Duration (NonSeasonal Category)');
                                       $('#guard_rails_err').show();
                                       f=false;
                                       return false;
                                    }
                                    
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
                                   //minimumval3=value;
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
                        var guard_each=0,guard_range=0,not_range_guard=0; 
                         $("[name^=guard_rails]").each(function () {
                             guard_each++;
                             var values=this.value;
                             column=$(this).attr('id');
                             var name=$(this).attr('name');
                            var sb=name.substr(13,1);
                            user_val=document.getElementById("guard_rails_user_id['"+sb+"']").value;
                            metric_id_value=document.getElementById("guard_rails_metric_id['"+sb+"']").value;
                            maxval1=document.getElementsByName("guard_rails['0']")[1].value;
                            maxval2=document.getElementsByName("guard_rails['1']")[1].value;
                            minimumval1=document.getElementsByName("guard_rails['0']")[0].value;
                             minimumval2=document.getElementsByName("guard_rails['1']")[0].value;
                            if((metric_id_value=='1')&& (column=='minimum')&&(this.value>=(30))&&(this.value<=(120))&&(this.value!="")&&(values<=parseInt(maxval1))){
                                guard_range++;
                            }
                            else if((metric_id_value=='1') && (column=='maximum')&& (values>=(30))&&(values<=(120))&&(values!="")&&(values>=parseInt(minimumval1)))
                            {
                                guard_range++;
                            }
                            else if((metric_id_value=='2') && (column=='minimum')&& (values>=(30))&&(values<=(120))&&(values!="")&&(values<=parseInt(maxval2)))
                            {
                                guard_range++;
                            }
                            else if((metric_id_value=='2') && (column=='maximum')&& (values>=(30))&&(values<=(120))&&(values!="")&&(values>=parseInt(minimumval2)))
                            {
                                guard_range++;
                            }
                            else if((metric_id_value=='3') && (column=='minimum')&& (values>=(2))&&(values<=(5))&&(values!=""))
                            {
                                guard_range++;
                            }
                            else if((metric_id_value=='3') && (column=='maximum')&& (values>=(10))&&(values<=(100))&&(values!=""))
                            {
                                guard_range++;
                            }
                            else if((metric_id_value=='4') && (column=='minimum')&& (values>=(1))&&(values<=(2))&&(values!=""))
                            {
                               guard_range++; 
                            }
                            else if((metric_id_value=='4') && (column=='maximum')&& (values>=(5))&&(values<=(25))&&(values!=""))
                            {
                               guard_range++; 
                            }
                            else{
                               not_range_guard++;
                            }
                         });
                        var Updated_Values = JSON.stringify(UpValue);
                        if(f==true && guard_each==guard_range && not_range_guard==0){
                           if(k==0){ var r=confirm('Are you sure you want to update this value?'); }
                            if(r==true){  
                                jQuery.ajax({
                                    type: "POST",
                                    url: server+"php/GuardRails_Update.php?arr="+Updated_Values,
                                    data: {
                                        'Updated_Values':Updated_Values
                                    },
                    
                                    success: function(data){
                                        if((typeof data == 'string' || data instanceof String)&& data.length>3) {
                                            $('#updating').html(data);
                                            $('#updating').show();
                                        }
                                        else if(data.length<=4){
                                            $('#updating').html('Your updates were saved');
                                            $('#updating').show(); 
                                       }
                                       else{
                                           $('#updating').html('Update Failed');
                                           $('#updating').show();     
                                       }
                                    },
                                    error:function(event){
                                        alert('error'+event.message);
                                    }
                                });
                                if($.browser.version=='9.0'){
                                k++;}
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
                                if((metric_id_value=='1')&&(column=='minimum')){
                                    maxval0=document.getElementsByName("val_con['1']")[1].value;
                                    if((value>=(0))&&(value<=(120))&&(value!=""))
                                    {
                                       if(value<=parseInt(maxval0)){
                                        $(this).css("background-color","white");
                                        GuardRails_Checking(value,column,user_val,metric_id_value);
                                       }
                                       else{
                                          $(this).css("background-color","yellow");
                                          $('#Val_control_err').html('Minimum value exceeds maximum value for Margin');
                                          $('#Val_control_err').show();
                                          f=false;
                                          return false; 
                                       }
                                    
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Please Enter Value between 0 and 120');
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
                                    minval0=document.getElementsByName("val_con['1']")[0].value;
                                    if((value>=(0))&&(value<=(120))&&(value!=""))
                                    {
                                        if(value>=parseInt(minval0)){
                                        $(this).css("background-color","white");
                                        GuardRails_Checking(value,column,user_val,metric_id_value);
                                        }
                                        else{
                                          $(this).css("background-color","yellow");
                                          $('#Val_control_err').html('Maximum value is less than minimum value for Margin');
                                          $('#Val_control_err').show();
                                          f=false;
                                          return false;  
                                        }
                                    
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Please enter value between 0 and 120');
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
                                else if((metric_id_value=='2')&&(column=='minimum'))
                                {
                                    maxval1=document.getElementsByName("val_con['2']")[1].value;
                                    if((value>=(10))&&(value<=(120))&&(value!=""))
                                    {
                                        if(value<=parseInt(maxval1)){
                                        $(this).css("background-color","white");
                                        GuardRails_Checking(value,column,user_val,metric_id_value);
                                        }
                                        else{
                                          $(this).css("background-color","yellow");
                                          $('#Val_control_err').html('Minimum value exceeds maximum value for Program ROI Goal');
                                          $('#Val_control_err').show();
                                          f=false;
                                          return false; 
                                        }
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Please Enter Value between 10 and 120');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    }
                                    else
                                    {
                                        $(this).css("background-color","red");
                                        $('#Val_control_err').html('Please Enter Value between 10 and 120');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    } 
                                    
                                }
                                else if((metric_id_value=='2')&&(column=='maximum'))
                                {
                                    minval1=document.getElementsByName("val_con['2']")[0].value;
                                    if((value>=(10))&&(value<=(120))&&(value!=""))
                                    {
                                        if(value>=parseInt(minval1)){
                                        $(this).css("background-color","white");
                                        GuardRails_Checking(value,column,user_val,metric_id_value);
                                        }
                                        else{
                                         $(this).css("background-color","yellow");
                                         $('#Val_control_err').html('Maximum value is less than minimum value for Program ROI Goal');
                                         $('#Val_control_err').show();
                                         f=false;
                                         return false;   
                                        }
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Please enter value between 10 and 120');
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
                                else if((metric_id_value=='3')&&(column=='minimum'))
                                {
                                    maxval2=document.getElementsByName("val_con['3']")[1].value;
                                    if((value>=(1))&&(value<=(30))&&(value!=""))
                                    {
                                        if(value<=parseInt(maxval2)){
                                        $(this).css("background-color","white");
                                        GuardRails_Checking(value,column,user_val,metric_id_value);
                                        }
                                        else{
                                         $(this).css("background-color","yellow");
                                         $('#Val_control_err').html('Minimum value exceeds maximum value for Purchase Eligiblity');
                                         $('#Val_control_err').show();
                                         f=false;
                                         return false;  
                                        }
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Please Enter Value between 1 and 30');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    }
                                    else
                                    {
                                        $(this).css("background-color","red");
                                        $('#Val_control_err').html('Please Enter Value between 1 and 30');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    } 
                                    
                                }
                                else if((metric_id_value=='3')&&(column=='maximum'))
                                {
                                    minval2=document.getElementsByName("val_con['3']")[0].value;
                                    if((value>=(1))&&(value<=(30))&&(value!=""))
                                    {
                                        if(value>=parseInt(minval2)){
                                        $(this).css("background-color","white");
                                        GuardRails_Checking(value,column,user_val,metric_id_value);
                                        }
                                        else{
                                          $(this).css("background-color","yellow");
                                          $('#Val_control_err').html('Maximum value is less than minimum value for Purchase Eligiblity');
                                          $('#Val_control_err').show();
                                          f=false;
                                          return false;  
                                        }
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Please enter value between 1 and 30');
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
                                else if((metric_id_value=='4')&&(column=='minimum'))
                                {
                                    maxval3=document.getElementsByName("val_con['4']")[1].value;
                                    if((value>=(30))&&(value<=(100))&&(value!=""))
                                    {
                                        if(value<=parseInt(maxval3)){
                                        $(this).css("background-color","white");
                                        GuardRails_Checking(value,column,user_val,metric_id_value);
                                        }
                                        else{
                                          $(this).css("background-color","yellow");
                                          $('#Val_control_err').html('Minimum value exceeds maximum value for Purchase Cycle Adjustment');
                                          $('#Val_control_err').show();
                                          f=false;
                                          return false;  
                                        }
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Please Enter Value between 30 and 100');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    }
                                    else
                                    {
                                        $(this).css("background-color","red");
                                        $('#Val_control_err').html('Please Enter Value between 30 and 100');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    } 
                                }
                                else if((metric_id_value=='4')&&(column=='maximum'))
                                {
                                    minval3=document.getElementsByName("val_con['4']")[0].value;
                                    if((value>=(30))&&(value<=(100))&&(value!=""))
                                    {
                                        if(value>=parseInt(minval3)){
                                        $(this).css("background-color","white");
                                        GuardRails_Checking(value,column,user_val,metric_id_value);
                                        }
                                        else{
                                         $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Maximum value is less than minimum value for Purchase Cycle Adjustment');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;   
                                        }
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Please enter value between 30 and 100');
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
                                else if((metric_id_value=='5')&&(column=='minimum'))
                                {
                                    maxval4=document.getElementsByName("val_con['5']")[1].value;
                                    if((value>=(5))&&(value<=(120))&&(value!=""))
                                    {
                                        if(value<=parseInt(maxval4)){
                                        $(this).css("background-color","white");
                                        GuardRails_Checking(value,column,user_val,metric_id_value);
                                        }
                                        else{
                                          $(this).css("background-color","yellow");
                                          $('#Val_control_err').html('Minimum value exceeds maximum value for Category Performance Adjustment');
                                          $('#Val_control_err').show();
                                          return false;  
                                        }
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Please Enter Value between 5 and 120');
                                        $('#Val_control_err').show();
                                        return false;
                                    }
                                    else
                                    {
                                        $(this).css("background-color","red");
                                        $('#Val_control_err').html('Please Enter Value between 5 and 120');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    } 
                                }
                                else if((metric_id_value=='5')&&(column=='maximum'))
                                {
                                    minval4=document.getElementsByName("val_con['5']")[0].value;
                                    if((value>=(5))&&(value<=(120))&&(value!=""))
                                    {
                                        if(value>=parseInt(minval4)){
                                        $(this).css("background-color","white");
                                        GuardRails_Checking(value,column,user_val,metric_id_value);
                                        }
                                        else{
                                          $(this).css("background-color","yellow");
                                          $('#Val_control_err').html('Maximum value is less than minimum value for Category Performance Adjustment');
                                          $('#Val_control_err').show();
                                          return false;  
                                        }
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Please enter value between 5 and 120');
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
                                else if((metric_id_value=='6')&&(column=='minimum'))
                                {
                                    maxval5=document.getElementsByName("val_con['6']")[1].value;
                                    if((value>=(30))&&(value<=(120))&&(value!=""))
                                    {
                                       if(value<=parseInt(maxval5)){
                                        $(this).css("background-color","white");
                                        GuardRails_Checking(value,column,user_val,metric_id_value);
                                       }
                                       else{
                                         $(this).css("background-color","yellow");
                                         $('#Val_control_err').html('Minimum value exceeds maximum value for Program Duration');
                                         $('#Val_control_err').show();
                                         f=false;
                                         return false;  
                                       }
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Please Enter Value between 30 and 120');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    }
                                    else
                                    {
                                        $(this).css("background-color","red");
                                        $('#Val_control_err').html('Please Enter Value between 30 and 120');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    }  
                                }
                                else if((metric_id_value=='6')&&(column=='maximum'))
                                {
                                    minval5=document.getElementsByName("val_con['6']")[0].value;
                                    if((value>=(30))&&(value<=(120))&&(value!=""))
                                    {
                                        if(value>=parseInt(minval5)){
                                          $(this).css("background-color","white");
                                          GuardRails_Checking(value,column,user_val,metric_id_value);
                                        }
                                        else{
                                         $(this).css("background-color","yellow");
                                         $('#Val_control_err').html('Maximum value is less than minimum value for Program Duration');
                                         $('#Val_control_err').show();
                                         f=false;
                                         return false;  
                                        }
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Please enter value  between 30 and 120');
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
                                else if((metric_id_value=='7')&&(column=='minimum'))
                                {
                                    maxval6=document.getElementsByName("val_con['7']")[1].value;
                                    if((value>=(30))&&(value<=(50))&&(value!=""))
                                    {
                                        if(value<=parseInt(maxval6)){
                                          $(this).css("background-color","white");
                                          GuardRails_Checking(value,column,user_val,metric_id_value);
                                        }
                                        else{
                                          $(this).css("background-color","yellow");
                                          $('#Val_control_err').html('Minimum value exceeds maximum value for Reward Value');
                                          $('#Val_control_err').show();
                                          f=false;
                                          return false;  
                                        }
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Please Enter  Value between 30 and 50');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    }
                                    else
                                    {
                                        $(this).css("background-color","red");
                                        $('#Val_control_err').html('Please Enter  Value between 30 and 50');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    }  
                                }
                                else if((metric_id_value=='7')&&(column=='maximum'))
                                {
                                    minval6=document.getElementsByName("val_con['7']")[0].value;
                                    if((value>=(30))&&(value<=(50))&&(value!=""))
                                    {
                                        if(value>=parseInt(minval6)){
                                         $(this).css("background-color","white");
                                         GuardRails_Checking(value,column,user_val,metric_id_value);
                                        }
                                        else{
                                         $(this).css("background-color","yellow");
                                         $('#Val_control_err').html('Maximum value is less than minimum value for Reward Value');
                                         $('#Val_control_err').show();
                                         f=false;
                                         return false;  
                                        }
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Please enter value between 30 and 50');
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
                                else if((metric_id_value=='8')&&(column=='minimum'))
                                {
                                    maxval7=document.getElementsByName("val_con['8']")[1].value;
                                    if((value>=(5))&&(value<=(100))&&(value!=""))
                                    {
                                       if(value<=parseInt(maxval7)){
                                        $(this).css("background-color","white");
                                        GuardRails_Checking(value,column,user_val,metric_id_value);
                                       }
                                       else{
                                         $(this).css("background-color","yellow");
                                         $('#Val_control_err').html('Minimum value exceeds maximum value for Purchase Requirement');
                                         $('#Val_control_err').show();
                                         f=false;
                                         return false;  
                                       }
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Please Enter Value between 5 and 100');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    }
                                    else
                                    {
                                        $(this).css("background-color","red");
                                        $('#Val_control_err').html('Please Enter Value between 5 and 100');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    }  
                                }
                                else if((metric_id_value=='8')&&(column=='maximum'))
                                {
                                    minval7=document.getElementsByName("val_con['8']")[0].value;
                                    if((value>=(5))&&(value<=(100))&&(value!=""))
                                    {
                                        if(value>=parseInt(minval7)){
                                          $(this).css("background-color","white");
                                          GuardRails_Checking(value,column,user_val,metric_id_value);
                                        }
                                        else{
                                          $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Maximum value is less than minimum value for Purchase Requirement');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;  
                                        }
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Please enter value between 5 and 100');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    }
                                    else
                                    {
                                        $(this).css("background-color","red");
                                        $('#Val_control_err').html('Please Enter Value between 5 and 100');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    }  
                                }
                                else if((metric_id_value=='9') &&(column=='minimum'))
                                {
                                    maxval8=document.getElementsByName("val_con['9']")[1].value;
                                    if((value>=(1))&&(value<=(25))&&(value!=""))
                                    {
                                       if(value<=parseInt(maxval8)){
                                        $(this).css("background-color","white");
                                        GuardRails_Checking(value,column,user_val,metric_id_value);
                                       }
                                       else{
                                        $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Minimum value exceeds maximum value for Offers per Deck');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;   
                                       }
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Please Enter Value between 1 and 25');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    }
                                    else
                                    {
                                        $(this).css("background-color","red");
                                        $('#Val_control_err').html('Please Enter Value between 1 and 25');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;
                                    }  
                                }
                                else if((metric_id_value=='9')&&(column=='maximum'))
                                {
                                    minval8=document.getElementsByName("val_con['9']")[0].value;
                                    if((value>=(1))&&(value<=(25))&&(value!=""))
                                    {
                                       if(value>=parseInt(minval8)){
                                        $(this).css("background-color","white");
                                        GuardRails_Checking(value,column,user_val,metric_id_value);
                                       }
                                       else{
                                        $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Maximum value is less than minimum value for Offers per Deck');
                                        $('#Val_control_err').show();
                                        f=false;
                                        return false;   
                                       }
                                    }
                                    else if(value=="")
                                    {
                                        $(this).css("background-color","yellow");
                                        $('#Val_control_err').html('Please enter a value between 1 and 25');
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
                        var control_each=0,control_range=0,not_range_control=0; 
                         $("[name^=val_con]").each(function () {
                             control_each++;
                             var values=this.value;
                             column=$(this).attr('id');
                             var name=$(this).attr('name');
                                var sb=name.substr(9,1);
                                user_val=document.getElementById("val_control_user_id['"+sb+"']").value;
                                metric_id_value=document.getElementById("val_control_metric_id['"+sb+"']").value;
                                maxval0=document.getElementsByName("val_con['1']")[1].value;
                                minval0=document.getElementsByName("val_con['1']")[0].value;
                                maxval1=document.getElementsByName("val_con['2']")[1].value;
                                minval1=document.getElementsByName("val_con['2']")[0].value;
                                maxval2=document.getElementsByName("val_con['3']")[1].value;
                                minval2=document.getElementsByName("val_con['3']")[0].value;
                                maxval3=document.getElementsByName("val_con['4']")[1].value;
                                minval3=document.getElementsByName("val_con['4']")[0].value;
                                maxval4=document.getElementsByName("val_con['5']")[1].value;
                                minval4=document.getElementsByName("val_con['5']")[0].value;
                                maxval5=document.getElementsByName("val_con['6']")[1].value;
                                minval5=document.getElementsByName("val_con['6']")[0].value;
                                maxval6=document.getElementsByName("val_con['7']")[1].value;
                                minval6=document.getElementsByName("val_con['7']")[0].value;
                                maxval7=document.getElementsByName("val_con['8']")[1].value;
                                minval7=document.getElementsByName("val_con['8']")[0].value;
                                maxval8=document.getElementsByName("val_con['9']")[1].value;
                                minval8=document.getElementsByName("val_con['9']")[0].value;
                            if((metric_id_value=='1')&&(column=='minimum')&&(this.value>=(0))&&(this.value<=(120))&&(this.value!="")&&(values<=parseInt(maxval0))){
                                control_range++;
                            }
                            else if((metric_id_value=='1') &&(column=='maximum')&&(values>=(0))&&(values<=(120))&&(values!="")&&(values>=parseInt(minval0)))
                            {
                                control_range++;
                            }
                            else if((metric_id_value=='2') &&(column=='minimum')&&(values>=(10))&&(values<=(120))&&(values!="")&&(values<=parseInt(maxval1)))
                            {
                                control_range++;
                            }
                            else if((metric_id_value=='2') &&(column=='maximum')&&(values>=(10))&&(values<=(120))&&(values!="")&&(values>=parseInt(minval1)))
                            {
                                control_range++;
                            }
                            else if((metric_id_value=='3')&&(column=='minimum')&& (values>=(1))&&(values<=(30))&&(values!="")&&(values<=parseInt(maxval2)))
                            {
                                control_range++;
                            }
                            else if((metric_id_value=='3')&&(column=='maximum')&& (values>=(1))&&(values<=(30))&&(values!="")&&(values>=parseInt(minval2)))
                            {
                                control_range++;
                            }
                            else if((metric_id_value=='4')&&(column=='minimum')&& (values>=(30))&&(values<=(100))&&(values!="")&&(values<=parseInt(maxval3)))
                            {
                               control_range++; 
                            }
                            else if((metric_id_value=='4')&&(column=='maximum')&& (values>=(30))&&(values<=(100))&&(values!="")&&(values>=parseInt(minval3)))
                            {
                               control_range++; 
                            }
                            else if((metric_id_value=='5')&&(column=='minimum')&& (values>=(5))&&(values<=(120))&&(values!="")&&(values<=parseInt(maxval4)))
                            {
                               control_range++; 
                            }
                            else if((metric_id_value=='5')&&(column=='maximum')&& (values>=(5))&&(values<=(120))&&(values!="")&&(values>=parseInt(minval4)))
                            {
                               control_range++; 
                            }
                            else if((metric_id_value=='6')&&(column=='minimum')&& (values>=(30))&&(values<=(120))&&(values!="")&&(values<=parseInt(maxval5)))
                            {
                               control_range++; 
                            }
                            else if((metric_id_value=='6')&&(column=='maximum')&& (values>=(30))&&(values<=(120))&&(values!="")&&(values>=parseInt(minval5)))
                            {
                               control_range++; 
                            }
                            else if((metric_id_value=='7')&&(column=='minimum')&& (values>=(30))&&(values<=(50))&&(values!="")&&(values<=parseInt(maxval6)))
                            {
                               control_range++; 
                            }
                            else if((metric_id_value=='7')&&(column=='maximum')&& (values>=(30))&&(values<=(50))&&(values!="")&&(values>=parseInt(minval6)))
                            {
                               control_range++; 
                            }
                            else if((metric_id_value=='8')&&(column=='minimum')&& (values>=(5))&&(values<=(100))&&(values!="")&&(values<=parseInt(maxval7)))
                            {
                               control_range++; 
                            }
                            else if((metric_id_value=='8')&&(column=='maximum')&& (values>=(5))&&(values<=(100))&&(values!="")&&(values>=parseInt(minval7)))
                            {
                               control_range++; 
                            }
                            else if((metric_id_value=='9')&&(column=='minimum')&& (values>=(1))&&(values<=(25))&&(values!="")&&(values<=parseInt(maxval8)))
                            {
                               control_range++; 
                            }
                            else if((metric_id_value=='9')&&(column=='maximum')&& (values>=(1))&&(values<=(25))&&(values!="")&&(values>=parseInt(minval8)))
                            {
                               control_range++; 
                            }
                            else{
                               not_range_control++;
                            }
                         });
                        var Updated_Values = JSON.stringify(UpValue);
                        if(f==true && control_each==control_range && not_range_control==0){
                            if(k==0){var r=confirm('Are you sure you want to update this value?'); }
                            if(r==true){  
                          jQuery.ajax({
                            type: "POST",
                            url: server+"php/ValControls_Update.php?arr="+Updated_Values,
                            data: {
                                'Updated_Values':Updated_Values
                            },
                            success: function(data){
                                       if((typeof data == 'string' || data instanceof String)&& data.length>3) {
                                            $('#updating').html(data);
                                            $('#updating').show();
                                        }
                                        else if(data.length<=4){
                                            $('#updating').html('Your updates were saved');
                                            $('#updating').show(); 
                                       }
                                       else{
                                           $('#updating').html('Update Failed');
                                           $('#updating').show();     
                                       }
                            },
                            error:function(event){
                                alert('error'+event.message);
                            }
                          });
                          if($.browser.version=='9.0'){
                                k++;}
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
                               else if((parameter=='9'))
                                {
                                    if((value>=(10))&&(value<=(50))&&(value!=""))
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
                                        $('#pgm_param_err').html('Please Enter Value between 10 and 50 ');
                                        $('#pgm_param_err').show();
                                        f=false;
                                        return false;
                                    }  
                                }
                               
                            
                            else if((parameter=='6'))
                                {
                                    if((value>=(1))&&(value<=(25))&&(value!=""))
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
                                        $('#pgm_param_err').html('Please Enter Value between 1 and 25 ');
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
		   $('#drp_dwn_5').change(function(e) {
                        value=(e.target.options[e.target.selectedIndex].text);
                        column='p_value';
                        user_val=document.getElementById("pgm_param_user_id['0']").value;
                        parameter=5;edit=true;
                        GuardRails_Checking(value,column,user_val,parameter);
                    });
                    $('#drp_dwn_7').change(function(e) {
                        value=(e.target.options[e.target.selectedIndex].text);
                        column='p_value';
                        user_val=document.getElementById("pgm_param_user_id['0']").value;
                        parameter=7;edit=true;
                        GuardRails_Checking(value,column,user_val,parameter);
                    });
                    $('#drp_dwn_segment').change(function(e) {
                        value=(e.target.options[e.target.selectedIndex].text);
                        column='p_value';
                        user_val=document.getElementById("pgm_param_user_id['0']").value;
                        parameter=8;edit=true;
                        GuardRails_Checking(value,column,user_val,parameter);
                    });

                    $('#pgm_param_save').click(function() {
                        var pgm_each=0,pgm_range=0,not_range_pgm=0; 
                         $("[name^=pgm_param]").each(function () {
                             pgm_each++;
                             var values=this.value;
                             var name=$(this).attr('name');
                             var sb=name.substr(11,1);
                             parameter=document.getElementById("pgm_parameter_id['"+sb+"']").value;
                            if((parameter=='1')&&(this.value>=(1))&&(this.value<=(10))&&(this.value!="")){
                                pgm_range++;
                            }
                            else if(((parameter=='2') || (parameter=='3')) &&(values>=(1))&&(values<=(5))&&(values!="")){
                                pgm_range++;
                            }
                            else if((parameter=='9') &&(values>=(10))&&(values<=(50))&&(values!="")){
                                pgm_range++;
                            }
                            else if((parameter=='6') &&(values>=(1))&&(values<=(25))&&(values!="")){
                                pgm_range++;
                            }
                            else if((parameter=='4')&& (values>=(5))&&(values<=(7))&&(values!=""))
                            {
                               pgm_range++; 
                            }
                            else{
                               not_range_pgm++;
                            }
                        });
                        var Updated_Values = JSON.stringify(UpValue);
                        if(f==true && pgm_each==pgm_range && not_range_pgm==0){
                           if(k==0){ var r=confirm('Are you sure you want to update this value?');}
                            if(r==true){ 
                                jQuery.ajax({
                                    type: "POST",
                                    url: server+"php/ProgramParameter_Update.php?arr="+Updated_Values,
                                    data: {
                                        'Updated_Values':Updated_Values
                                    },
                                    success: function(data){
                                        if((typeof data == 'string' || data instanceof String)&& data.length>3) {
                                           $('#pgm_param_updating').html(data);
                                           $('#pgm_param_updating').show();
                                        }
                                        else if(data.length<=4){
                                           $('#pgm_param_updating').html('Your updates were saved');
                                           $('#pgm_param_updating').show(); 
                                        }
                                        else{
                                           $('#pgm_param_updating').html('Update Failed');
                                           $('#pgm_param_updating').show();     
                                       }
                                    },
                                    error:function(event){
                                        alert('error'+event.message);
                                    }
                                });
                                if($.browser.version=='9.0'){
                                k++;}
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
                    $('#pro_cat_save').hide();
                    
                $('#drp_dwn_super_category').change(function(e) {cnt++;
                        desc=(e.target.options[e.target.selectedIndex].text);
                        vals=(e.target.options[e.target.selectedIndex].value);
                        user_val=document.getElementById("username").value;
                        $.post(server+'php/EligibleProduct.php?l5_cat='+vals, {
                            "l5_cat": vals
                        }, function (txt) {
                                
                             $('#samples').html(txt);

                             //$('#samples #supers').show();
                            $('#samples #prheading').hide();
			    $('#samples #headings').hide();
			    $('#samples .mainmenu').hide();
			    $('#samples #logout').hide();
			    $('#samples #logo').hide();
			    $('#samples #mainmenubg').hide();
			    $('#samples #bottomstripe').hide();
                            $('#samples #drp_dwn_super_category').hide();
                            $('#samples #super').hide();
                            $('#samples .prod_cat_updating').hide();
                            $('.prod_cat_updating').hide();
                            $('#samples #pro_cat_save').hide();
                            //$('#samples #prod_cat_ancel').hide();
                             $('#pro_cat_save').hide();
                            //$('#prod_cat_ancel').hide();
                            $('#update #prod_div_ancel .btn').hide();
                            $('#update #samples #prod_div_ancel .btn').css("display","inline-block");
                            $('#prod_cat_err').hide();
                            
                        });$('#update #prod_cat_ancel').hide();
                    });
                    $('#drp_dwn_l4_category').change(function(e) {l4_cnt++;
                        desc=(e.target.options[e.target.selectedIndex].text);
                        val=(e.target.options[e.target.selectedIndex].value);
                        $('#update #prod_cat_ancel').hide();
                        $.post(server+'php/EligibleProduct.php?sup_id='+val, {
                            "sup_id": val
                        }, function (txt) {
                                
                             $('#sample').html(txt);
			     $('#sample #drp_dwn_l4_category').show();
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
                            $('#samples #pro_cat_save').show();
                            $('#samples #prod_cat_ancel').show();
                            $('#prod_cat_err').hide();
                            $('#pro_cat_save').hide();
                            $('#prod_cat_ancel').hide();
                            
			    $('#sample #supers').hide();
                                  
                        });$('#samples #prod_cat_ancel').show();
                    });
                     
                    $("input[type=checkbox]").each ( function() {
                         $("input[type=checkbox]").change( function() {

                              if(this.checked) {
                                //alert('checked');
                                edit=true;
                                value='YES';
                                column=$(this).attr('id');
                                var name=$(this).attr('name');
                                var sb=name.substr(7,1);
                                user_val=document.getElementById("prod_cat_user_id["+sb+"]").value;
                                super_cat_code=document.getElementById("super_cat_code["+sb+"]").value;
                                super_cat_id=document.getElementById("super_cat_id["+sb+"]").value;
                                prod_cat_id=document.getElementById("prod_cat_id["+sb+"]").value;
                                if(col_val=="")
                                    {
                                        col_val=value;
                                        col_name=column;
                                        user_val=user_val;
                                        index_val=super_cat_id;
                                        category_code=super_cat_code;
                                        pro_cat_id=prod_cat_id;
                                        var UP_Value = {  
                                            "col_nam" :col_name,                                
                                            "col_value" :col_val,
                                            "user_id_val" :user_val,
                                            "sup_id_val":index_val,
                                            "cat_code":category_code,
                                            "prod_id_val":pro_cat_id
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
                                        pro_cat_id=prod_cat_id;
                                        var UP_Value = {  
                                            "col_nam" :col_name,                                
                                            "col_value" :col_val,
                                            "user_id_val" :user_val,
                                            "sup_id_val":index_val,
                                            "cat_code":category_code,
                                            "prod_id_val":pro_cat_id
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
                            else
                                {
                                    //alert('not checked');
                                    edit=true;
                                value='NO';
                                column=$(this).attr('id');
                                var name=$(this).attr('name');
                                var sb=name.substr(7,1);
                                user_val=document.getElementById("prod_cat_user_id["+sb+"]").value;
                                super_cat_code=document.getElementById("super_cat_code["+sb+"]").value;
                                super_cat_id=document.getElementById("super_cat_id["+sb+"]").value;
                                prod_cat_id=document.getElementById("prod_cat_id["+sb+"]").value;
                                if(col_val=="")
                                    {
                                        col_val=value;
                                        col_name=column;
                                        user_val=user_val;
                                        index_val=super_cat_id;
                                        category_code=super_cat_code;
                                        pro_cat_id=prod_cat_id;
                                        var UP_Value = {  
                                            "col_nam" :col_name,                                
                                            "col_value" :col_val,
                                            "user_id_val" :user_val,
                                            "sup_id_val":index_val,
                                            "cat_code":category_code,
                                            "prod_id_val":pro_cat_id
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
                                        pro_cat_id=prod_cat_id;
                                        var UP_Value = {  
                                            "col_nam" :col_name,                                
                                            "col_value" :col_val,
                                            "user_id_val" :user_val,
                                            "sup_id_val":index_val,
                                            "cat_code":category_code,
                                            "prod_id_val":pro_cat_id
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
                           });     
                        }); 
                    $('#pro_cat_save').click(function() {
                        var Updated_Values = JSON.stringify(UpValue);
                        if(f==true){
                          if(k==0){ var r=confirm('Are you sure you want to update this value?'); }
                          if(r==true){
                            jQuery.ajax({
                                type: "POST",
                                url: server+"php/EligibleProducts_Update.php?arr="+Updated_Values,
                                data: {
                                    'Updated_Values':Updated_Values
                                },
                                success: function(data){

                                    if((typeof data == 'string' || data instanceof String)&& data.length>3) {
                                       $('.prod_cat_updating').html(data);
                                       $('.prod_cat_updating').show();
				       $('#sample .prod_cat_updating').hide();
                                       $('#samples .prod_cat_updating').hide();
                                   }
                                   else if(data.length<=4){
                                       $('.prod_cat_updating').html('Your updates were saved');
                                       $('.prod_cat_updating').show();
                                       $('#sample .prod_cat_updating').hide();
                                       $('#samples .prod_cat_updating').hide();
                                   }
                                  else{
                                      $('.prod_cat_updating').html('Update Failed ');
                                      $('.prod_cat_updating').show();
                                      $('#sample .prod_cat_updating').hide();
                                      $('#samples .prod_cat_updating').hide();
                                  }
                                },
                                error:function(event){
                                    alert('error'+event.message);
                                }
                            });
                            if( $.browser.version=='9.0'){
                                k++;}
                         }
                        }
                        else
                        {
                            if(edit==true)   {
                               $('.prod_cat_updating').hide();
                                    $('#sample .prod_cat_updating').hide();
                                    $('#samples .prod_cat_updating').hide();
                                    $('#prod_cat_err').html('Please check a value YES/NO');
                                    $('#prod_cat_err').show(); 
                            } 
                            else{
                                $('.prod_cat_updating').hide();
                                    $('#sample .prod_cat_updating').hide();
                                    $('#samples .prod_cat_updating').hide();
                                    $('#prod_cat_err').html('No Changes');
                                    $('#prod_cat_err').show();
                            }
                        }
                    });

           
            
               
            });     
     //   });
    });
});
