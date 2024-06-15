/** lov-list-spa-sys.js
 *  This javascript file is the main SPA System for LOV Form page
 */

//Get Total of LOV Categories: async falsey
$('#loader').removeClass('hide');
$.ajax({
    "type": "GET",
    "url": "list-of-value/get-lov-cat-total",
    "success": function(e){
        $('#loader').addClass('hide');
        $('#total').val(e["total"]);
    },
    "error": function(e){
        $('#loader').addClass('hide');
        lovTiles.empty();
        alert("Sesi anda telah berakhir. Silahkan login kembali.");
        window.location = "/";
    }
}).done(function(){
    //Constant
    const BLOCK = "fa-th";
    const LIST = "fa-list";

            //View Mode Button
    let lovViewMode = $('#lov-view-mode');
    let iconViewMode = $('#lov-view-mode i');
    let lovTiles = $('#lov-cat-tiles');


    /* View Mode Button event listener
    * if it clicked, check the class. If it has fa-th class, change it to fa-list, 
    * and run an ajax to load the data listly. And vice-versa
    */
    lovViewMode.on("click", function(e){
        presentation = "";
        if(iconViewMode.hasClass(BLOCK))
            presentation = "LISTVIEW";
        else if(iconViewMode.hasClass(LIST))
            presentation = "TILES";

        $('#loader').removeClass('hide');

        $.ajax({
            "type": "GET",
            "url": "list-of-value/get-lov-cat-tiles",
            "data": {
                "perPage": $('#total').val(),
                "presentation": presentation
            },
            "dataType": "html",
            "success": function(e){
                $('#loader').addClass('hide');

                if(iconViewMode.hasClass(BLOCK)){
                    iconViewMode.removeClass(BLOCK);
                    iconViewMode.addClass(LIST);
                }else if(iconViewMode.hasClass(LIST)){
                    iconViewMode.removeClass(LIST);
                    iconViewMode.addClass(BLOCK);
                }

                lovTiles.empty();
                lovTiles.append(e);
            },
            "error": function(e){
                $('#loader').addClass('hide');

                lovTiles.empty();
                alert("Sesi anda telah berakhir. Silahkan login kembali.");
                window.location = "/";
            }
        });
    }); //End of change view mode

    lovViewMode.trigger("click");

    //End of View Mode Button

    //LOV Category Tiles setting

    //Searching Module

    let search = document.getElementById('search-cat');

    search.addEventListener('keyup', function(e){
        //Make text inside searchbox uppercase
        input = this.value.toUpperCase(); 

        //Get the element to search
        var tag = null;

        if(document.getElementById('th') != null){
            master = document.getElementById('th')
            tag = th.getElementsByClassName('col-6 col-md-4 col-xl-2');
        }else if(document.getElementById('ul') != null){
            master = document.getElementById('ul');
            tag = master.getElementsByTagName('li');
        }

        //Searching
        for(i = 0; i< tag.length; i++){
            txtValue = tag[i].innerText;

            if(document.getElementById('th') != null)
                txtValue = tag[i].getElementsByClassName('font-w600 mt-2 text-uppercase text-muted')[0].innerText;

            if(txtValue.toUpperCase().indexOf(input) > -1)
                tag[i].style.display = "";
            else
                tag[i].style.display = "none";
        }
    }); //End of search on lov category

    $('#loader').removeClass('hide');

    // Add new LOV Category section
    catSel = $('#cat-select');

    $.ajax({
        "type": "GET",
        "url": "list-of-value/get-lov-cat-tiles",
        "data": {
            "perPage": $('#total').val(),
            "returns": "JSON"
        },
        "dataType": "json",
        "success": function(e){
            $('#loader').addClass('hide');

            catSel.empty();
            catSel.append('<option value="0">No Parent</option>')
            e.forEach(function(e, v){
                catSel.append('<option value="'+e.lovCatId+'">'+e.lovValue+'</option>')
            });
        },
        "error": function(e){
            $('#loader').addClass('hide');
            lovTiles.empty();
            alert("Sesi anda telah berakhir. Silahkan login kembali.");
            window.location = "/";
        }
    });
}); //End of LOV Categories

//LOV Cat Values

let lov_tbl_value = $('#tbd-table-values');
let lov_detail_title_lyt = $('.lov-detail-title');

let cat_count = 0;
let cat_selected = "";
let lov_cat_parent = 0;
let lov_title = "";
let lov_key = "";
let lov_cat_id = 0;

function getLovCatById(id, count, lovKey, title, parentId){
    $('#loader').removeClass('hide');
    $('#src-field').val("");

    $.ajax({
        "type": "GET",
        "url": "list-of-value/lovcat/detail/"+id,
        "data": {
            "param": $('#dtValue').val()
        },
        "dataType": "html",
        "success": function(e){
            lov_tbl_value.empty();
            lov_tbl_value.append(e);

            lov_key = lovKey;
            lov_cat_parent = parentId;
            lov_title = title;
            cat_count = count;
            cat_selected = lovKey;
            lov_cat_id = id;
    
            $('#update-lov-category-modal-btn').prop("onclick", null).off("click");
            $('#update-lov-category-modal-btn').on("click", function(){
                ajaxModal('list-of-value/lovcat/update-modal/'+lov_cat_id);
            });
    
            $('#add-new-lov-btn').prop("onclick", null).off("click");
            $('#add-new-lov-btn').on("click", function(){
                ajaxModal('list-of-value/lovcat/create-lov-modal/'+lov_cat_id);
            });
    
            lov_detail_title_lyt.html('- '+lov_title);
            $('#lov-detail-key').html('(key: '+lov_key+')');

            $('#loader').addClass('hide');
        },
        "error": function(e){
            $('#loader').addClass('hide');
            lovTiles.empty();
            alert("Sesi anda telah berakhir. Silahkan login kembali.");
            window.location = "/";
        }
    });
} //End of getLOV Cat By Id

//List LOV DataTables
$(function() {
    let sel = document.getElementById('dtValue');
    let srcField = $('#src-field');
    let dtable = $('#dtables');

    //Initialize table
    var table = dtable.DataTable( {
        paging: false,
        ordering: false,
        searching: false,
        info: false,
    });

    //On Filter change
    $('#dtValue').on("change", function(e){
        srcField.val("");

        switch(sel.selectedIndex){
            case 2: 
                srcField.prop("placeholder", "Pencarian Bahasa Inggris");
                break;

            case 3: 
                srcField.prop("placeholder", "Pencarian Bahasa Indonesia");
                break;
        }
        $('#search-btn').trigger("click");
    }); //End of Filter changes

    //On search trigger

    $('#search-btn').on('click', function () {
        $('#loader').removeClass('hide');

        $.ajax({
            "type": "GET",
            "url": "list-of-value/lovcat/detail/"+lov_cat_id,
            "data": {
                "param": $('#dtValue').val(),
                "search": srcField.val()
            },
            "dataType": "html",
            "success": function(e){
                lov_tbl_value.empty();
                lov_tbl_value.append(e);
                $('#loader').addClass('hide');
            },
            "error": function(e){
                $('#loader').addClass('hide');
                lovTiles.empty();
                alert("Sesi anda telah berakhir. Silahkan login kembali.");
                window.location = "/";
            }
        });
    }); //End of Searching module

    // Hide Search Datatable
    $('.dataTables_filter input').addClass('form-control dt-user');
    $('.dt-user').addClass("hide");

}); //End of Datatables Document Ready