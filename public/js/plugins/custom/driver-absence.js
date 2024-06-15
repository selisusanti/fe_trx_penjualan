let filterBtn = $('#filter-btn');
let resetBtn = $('#reset-btn');


filterBtn.click(function(e){
    $('#absence-row').html('');
    $('#loader').removeClass('hide');

    var request = { 
        "start-time": $('#start-time').val(), 
        "end-time": $('#end-time').val()
    };

    //Ini yang buat Table
    $.ajax({
        type: "GET",
        data: request,
        dataType: "html",
        url: '/attendance-data/get-row', 
        success: function(e){
            $('#absence-row').append(e);
            
            $('#loader').addClass('hide');
        },
        error: function(xhr, status, error){
            alert("Error! Connection can't be established!\n"+ xhr.status + " "+ xhr.statusText);
            $('#loader').addClass('hide');
        }
    });
});


//Reset button
resetBtn.click(function(e){
    $('#start-time').val("");
    $('#end-time').val("");

    $('#end-time').prop('disabled', true);
    $('#end-time').addClass('disabled');
    
    $('#reset-btn').prop('disabled');
    $('#reset-btn').addClass('disabled');

    $('#filter-btn').prop('disabled', true);
    $('#filter-btn').addClass('disabled');

    $('#absence-row').html('');
    $('#loader').removeClass('hide');

    var request = { 
        "start-time": null, 
        "end-time": null
    };

    //Ini yang buat Table
    $.ajax({
        type: "GET",
        data: request,
        dataType: "html",
        url: '/attendance-data/get-row',
        success: function(e){
            $('#absence-row').append(e);
            $('#loader').addClass('hide');

        },
        error: function(xhr, status, error){
            alert("Error! Connection can't be established!\n"+ xhr.status + " "+ xhr.statusText);
            $('#loader').addClass('hide');
        }
    });
});