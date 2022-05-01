$(document).ready(function() {
    displayData();
});

function deleteUrl(url__)
{
    $.ajax({
        url:'delete.php',
        type:'post',
        data:{
            url_: url__
        },
        success:function(data,status){
            displayData();
        }
    })
}

function getDetails(url__)
{
   $('#updateModal').modal("show");
   $('#id').val(url__);

   $.post('update.php',{url:url__},function(data,status){
       var urlId=JSON.parse(data);
       $('#updateUrl').val(urlId.url);
       $('#updateDescription').val(urlId.description);
       $('#updateCategory').val(urlId.category);
   })
}

function displayData(){
    var display="true";
    window.$_GET = new URLSearchParams(location.search);
    var page = $_GET.get('page');
    var category = $_GET.get('category');
    if(category=="")
        {
        category=$('#browse-cat').val();
        console.log("empty:"+category);
    }
    if(page==null)
        page=1;
    $.ajax({
        url:'display.php',
        type:'post',
        data:{
            displaySend:display,
            page:page,
            cat:category
        },
        success:function(data,status)
        {
            $('#display-data').html(data);

        }
    })
    
}

function addUrl(){
    console.log('urlAdd');
    var urlAdd=$('#url').val();
    var decriptionAdd=$('#description').val();
    var categoryAdd=$('#category').val();
    $.ajax({
        url:'insert.php',
        type:'post',
        data:{
            url: urlAdd,
            description: decriptionAdd,
            category: categoryAdd
        },
        success:function(data,status){
            //console.log(status);
            displayData();
        }
    })
}

function updateUrl()
{
    var newUrl=$('#updateUrl').val();
    var newDescription=$('#updateDescription').val();
    var newCategory=$('#updateCategory').val();
    var oldUrl = $('#id').val();
    $.post("update.php",{
        newUrl:newUrl,
        newDescription:newDescription,
        newCategory:newCategory,
        oldUrl:oldUrl
    },function(data,status){
        $('#updateModal').modal("hide");
        displayData();
    })
    
}
