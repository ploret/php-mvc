$(document).ready(function() {
    
    /*
     * Customer registration
    */
    if (('#customer_register').length > 0) {
        
        $('input#register').click(function() {
            var name = $.trim($('input#name').val()),
                phone = $.trim($('input#phone').val()),
                email = $.trim($('input#email').val()),
                login = $.trim($('input#login').val()); 

                /*
                 * data is not valid
                 */
                if (name == '' ||  phone == '' ||  login == '' || !validateEmail(email)) {
                    $('.error_customer_register').show();
                    $('.success_customer_register').hide();
                }
                else {
                /*
                 * data is valid
                 */
                    var data = {
                        action: 'add_customer',
                        name: name,
                        phone: phone,
                        login: login,
                        email: email
                    }
                    
                    $.ajax({
                        url:"/customer/register",
                        type: 'POST',
                        data: data,
                        success:function(data){
                            if (data == 'ok') {
                                $('.error_customer_register').hide();
                                $('.success_customer_register').show();
                            } else if (data == 'bad') {
                                $('.success_customer_register').hide();
                                $('.error_customer_register').show();
                            }
                         }
                    });
                }
        });
    }
    
    /*
     * Service search
    */   
    
    if ($('#service_search').length > 0) {
        
        $('#search').click(function () {
            
            var firm_name = $.trim($('#firm_name').val());
            
            if (firm_name != '') {
                /*
                * offer customer to input his login
                */
                 var login = prompt("Please enter your login", "");

                    var data = {
                        action: 'service_search',
                        login: login
                    }
                    
                    $.ajax({
                        url:"/service/searchservice",
                        type: 'POST',
                        data: data,
                        success:function(data){
                            if (data == 'ok') {
                                
                            /*
                            * login valid
                            */
                                $('.error_service_search').hide();
                                var data = {
                                      action: 'get_services',
                                      firm_name: firm_name
                                  }
                    
                                $.ajax({
                                    url:"/service/searchservice",
                                    type: 'POST',
                                    data: data,
                                    success:function(data){
                                        /*
                                        * get services
                                        */
                                        
                                        if (data.length > 0) {
                                            $('.firm_not_exists').hide();
                                            $('#search_results').html('');
                                            
                                            for(var i=0; i<data.length; i++) {
                                               $('#search_results').append('<div>Service ID: '+ data[i]['service_id'] +'</div> <div>Service Name: '+ data[i]['service_name'] +'</div> <div>Service Description: '+ data[i]['service_description'] +'</div> <div><input type="button" id_service="'+data[i]['service_id']+'" login="'+login+'" class="buy_service" value="Buy service"></div> <hr>');
                                            }
                                            
                                        }
                                        else {
                                            /*
                                            * firm does not exist
                                            */
                                            $('.firm_not_exists').show();
                                            $('#search_results').html('');
                                        }
                                     }
                                });

                            } else if (data == 'bad') {
                                /*
                                * login is not corect
                                */
                                $('.error_service_search').show();
                                $('.firm_not_exists').hide();
                                $('#search_results').html('');
                            }
                        }
                    });

            }

        });
        

    }
    
    
    
    
    
    /*
     * Firm search
    */  
      if ($('#firm_search').length > 0) {
        

            $('#search').click(function () {

                var service_name = $.trim($('#service_name').val());

                if (service_name != '') {
                    /*
                    * offer customer to input his login
                    */
                     var login = prompt("Please enter your login", "");

                        var data = {
                            action: 'firm_search',
                            login: login
                        }

                        $.ajax({
                            url:"/firm/searchfirm",
                            type: 'POST',
                            data: data,
                            success:function(data){
                                if (data == 'ok') {
                                    /*
                                     * login is valid
                                     */
                                    $('.error_firm_search').hide();
                                    var data = {
                                          action: 'get_firms',
                                          service_name: service_name
                                      }

                                    $.ajax({
                                        url:"/firm/searchfirm",
                                        type: 'POST',
                                        data: data,
                                        success:function(data){
                                            /*
                                             * get firms
                                             */
                                            if (data.length > 0) {
                                                $('.service_not_exists').hide();
                                                $('#search_results').html('');

                                                for(var i=0; i<data.length; i++) {
                                                   $('#search_results').append('<div>Firm Name: '+ data[i]['firm_name'] +'</div>' + ' <hr>');
                                                }
                                            }
                                            else {
                                                /*
                                                 * service does not exist
                                                 */
                                                $('.service_not_exists').show();
                                                $('#search_results').html('');
                                            }

                                         }
                                    });

                                } else if (data == 'bad') {
                                    /*
                                    * login is not corect
                                    */
                                    $('.error_firm_search').show();
                                    $('.service_not_exists').hide();
                                    $('#search_results').html('');
                                }
                            }
                        });
                }
            });
        }
    
    
   
    
    
    /*
     * Serch services and firms by city
    */    
    if ($('#city_search').length > 0) {
        
        $('#search').click(function () {
            /*
             * selected city id
             */
            var city_id = $.trim($('#select_city option:selected').val());

            if (city_id > 0) {
                var login = prompt("Please enter your login", "");
                var data = {
                    action: 'search_by_city',
                    login: login
                }

                $.ajax({
                    url:"/firm/searchbycity",
                    type: 'POST',
                    data: data,
                    success:function(data){
                        if (data == 'ok') {
                            $('.incorrect_login').hide();
                            var data = {
                                  action: 'get_search_results',
                                  city_id: city_id
                            }

                            $.ajax({
                                url:"/firm/searchbycity",
                                type: 'POST',
                                data: data,
                                success:function(data){
                                    if (data.length > 0) {
                                        /*
                                         * Get services and firms from selected city
                                         */
                                        $('.city_no_results').hide();
                                        $('#search_results').html('');

                                        for(var i=0; i<data.length; i++) {
                                           $('#search_results').append(
                                                   '<div>Firm Name: '+ data[i]['firm_name'] +'</div>' + 
                                                   '<div>Service Name: '+ data[i]['service_name'] +'</div> <hr>');
                                        }
                                    }
                                    else {
                                        $('.city_no_results').show();
                                        $('#search_results').html('');
                                    }
                                 }
                            });

                        } else if (data == 'bad') {
                            $('.incorrect_login').show();
                            $('.city_no_results').hide();
                            $('#search_results').html('');
                        }
                    }
                });
            }
        });
    }
    

    
    
    /*
     * Add firm
    */   
      if (('#add_firm').length > 0) {
        
        $('input#register').click(function() {
            /*
             * Inputed data
             */
            var name = $.trim($('input#name').val()),
                phone = $.trim($('input#phone').val()),
                fio = $.trim($('input#fio').val()),
                login = $.trim($('input#login').val()),
                address = $.trim($('input#address').val()),
                city_id = parseInt($.trim($('#select_city option:selected').val()));

                /*
                 * Check inputed data
                 */
                if (name == '' ||  phone == '' ||  login == '' ||  fio == '' || address == '' || city_id <= 0 ) {
                    $('.firm_incorrect_data').show();
                    $('.firm_success_register').hide();
                }
                else {
                    var data = {
                        action: 'add_firm',
                        name: name,
                        phone: phone,
                        login: login,
                        fio: fio,
                        address: address,
                        city_id: city_id 
                    }
                    
                    $.ajax({
                        url:"/firm/addfirm",
                        type: 'POST',
                        data: data,
                        success:function(data){
                            /*
                             * Firm has been added successfully
                             */
                            if (data == 'ok') {
                                $('.firm_incorrect_data').hide();
                                $('.firm_success_register').show();
                            } else if (data == 'bad') {
                                $('.firm_incorrect_data').show();
                                $('.firm_success_register').hide();
                            }
                         }
                    });
                }
        });
    }
    
/*
 * Purchase a service
*/
    
    $('body').on('click', '.buy_service', function() {
        var service_id = $(this).attr('id_service'),
            login = $(this).attr('login');
        
            var data = {
                login: login,
                service_id: service_id
            }
        
            $.ajax({
                url:"/service/buyservice",
                type: 'POST',
                data: data,
                success:function(data){
                    /*
                     * Customer purchased a service
                     */
                    if (data == 'ok') {
                        alert('You purchased a service');
                    }
                 }
            });
    });
    
    
    /*
     * Add service
    */
    if (('#add_service').length > 0) {
        
        $('input#register').click(function() {
            /*
             * Inputed data
             */
            var name = $.trim($('input#name').val()),
                description = $.trim($('input#description').val()),
                profit = $.trim($('input#profit').val()),
                firm_id = parseInt($.trim($('#select_firm option:selected').val()));

                /*
                 * Check inputed data
                 */
                if (name == '' ||  description == '' ||  profit == '' || firm_id <= 0 ) {
                    $('.service_incorrect_data').show();
                    $('.service_success_register').hide();
                }
                else {
                    var data = {
                        action: 'add_service',
                        name: name,
                        description: description,
                        profit: profit,
                        firm_id: firm_id
                    }
                    
                    /*
                     * AJAX requst to add sevice
                     */
                    $.ajax({
                        url:"/service/addservice",
                        type: 'POST',
                        data: data,
                        success:function(data){
                            if (data == 'ok') {
                                $('.service_incorrect_data').hide();
                                $('.service_success_register').show();
                            } else if (data == 'bad') {
                                $('.service_incorrect_data').show();
                                $('.service_success_register').hide();
                            }
                        }
                    });
                }
        });

    }
   
    
    
    /*
     * Customers that used service
    */    

    if ($('#customers_used_service').length > 0) {

        $('#search').click(function () {
            /*
             * Get service name
             */
            var service_name = $.trim($('#service_name').val());

            if (service_name != '') {

                    var data = {
                          action: 'get_customers',
                          service_name: service_name
                      }

                    $.ajax({
                        url:"/service/customersusedservice",
                        type: 'POST',
                        data: data,
                        success:function(data){
                            /*
                             * Customers that used service
                             */

                            if (data.length > 0) {
                                $('.customers_not_used').hide();
                                $('#search_results').html('');

                                for(var i=0; i<data.length; i++) {
                                   $('#search_results').append('<div>Customer name: '+ data[i]['customer_name'] +'</div><div>Customer email: '+ data[i]['customer_email'] +' <hr>');
                                }
                            }
                            else {
                                $('.customers_not_used').show();
                                $('#search_results').html('');
                            }
                         }
                    });
            }
        });
    }
      
    
    /*
     * Customers that used firm
    */      

      if ($('#customers_used_firm').length > 0) {
        
            $('#search').click(function () {
                var firm = $.trim($('#firm_name').val());

                if (firm != '') {
                    var data = {
                          action: 'get_customers',
                          firm_name: firm
                      }

                    $.ajax({
                        url:"/firm/customersusedfirm",
                        type: 'POST',
                        data: data,
                        success:function(data){
                            if (data.length > 0) {
                                /*
                                 * Customers that used firm
                                 */
                                $('.customers_not_used').hide();
                                $('#search_results').html('');

                                for(var i=0; i<data.length; i++) {
                                   $('#search_results').append('<div>Customer name: '+ data[i]['customer_name'] +'</div><div>Customer email: '+ data[i]['customer_email'] +' <hr>');
                                }
                            }
                            else {
                                $('.customers_not_used').show();
                                $('#search_results').html('');
                            }
                         }
                    });
                }
            });
        }
        
      
    /*
     * "Service firm" firm earnings
    */            
    if ($('#earnings').length > 0) {

        $('#search').click(function () {

            /*
             * Get inputed data
             */
            var start_month = $.trim($('#start_month option:selected').val()),
                start_year = $.trim($('#start_year option:selected').val()),
                finish_month = $.trim($('#finish_month option:selected').val()),
                finish_year = $.trim($('#finish_year option:selected').val());

            /*
             * Convert date to timestamp
             */
            var start_timestamp = convertDateToTimestamp(start_month, start_year),
                finish_timestamp = convertDateToTimestamp(finish_month, finish_year);


            /*
             * Check validation time period
             */
            if (start_timestamp <= finish_timestamp) {

                    var data = {
                          action: 'get_earnings',
                          start_timestamp: start_timestamp,
                          finish_timestamp: finish_timestamp
                      }

                      /*
                       * AJAX request to get earnings
                       */

                    $.ajax({
                        url:"/billing/earnings",
                        type: 'POST',
                        data: data,
                        success:function(data){
                            /*
                             * Render earnings result
                             */
                            if (parseInt(data) >= 0) {
                                $('.earnings_error').hide();
                                $('#search_results_earnings').html('');
                                $('#search_results_earnings').append('<div>Earnings: '+ data +' UAH</div>');
                            }
                            else {
                                $('.earnings_error').hide();
                                $('#search_results_earnings').html('');
                            }
                         }
                    });
            }
            else {
                $('.earnings_error').show();
                $('#search_results_earnings').html('');
            }
      });
    }
});



/*
 * Check email validation
 */
function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 


/*
 * Convert date to timestamp
 */
function convertDateToTimestamp(month, year) {
    var date="01-"+ month +"-"+year;
    date=date.split("-");
    var date_new=date[1]+"/"+date[0]+"/"+date[2];
    return new Date(date_new).getTime() / 1000;   
}