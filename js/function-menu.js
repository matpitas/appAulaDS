$(document).ready(function(){


    $('.categoria').click(function(e){
        e.preventDefault()
        $('#conteudo').empty();
        $('#conteudo').load('src/categories/view/listCategories.html')
    })


})