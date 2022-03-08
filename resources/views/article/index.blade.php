@extends('layouts.app')

@section('content')

<div class="container">

    <h1>Aricle list</h1>

    <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#createArticleModal">
        Create New Article
    </button>

    <div id="alert" class="alert alert-success d-none mt-2">
    </div>



    <table id="articles-table" class="table table-striped mt-2">
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Type Id</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        @foreach ($articles as $article)
        <tr class="article{{$article->id}}">
            <td class="col-article-id">{{$article->id}}</td>
            <td class="col-article-title">{{$article->title}}</td>
            <td class="col-article-typeId">{{$article->type_id}}</td>
            <td class="col-article-description">{{$article->description}}</td>
            <td>

                <button class="btn btn-danger delete-article" type="submit" data-articleid="{{$article->id}}">DELETE</button>
                <button type="button" class="btn btn-primary show-article" data-bs-toggle="modal" data-bs-target="#showArticleModal" data-articleid="{{$article->id}}">Show</button>
                <button type="button" class="btn btn-secondary edit-article" data-bs-toggle="modal" data-bs-target="#editArticleModal" data-articleid="{{$article->id}}">Edit</button>

            </td>
        </tr>
        @endforeach
    </table>

    <table class="template d-none">
        <tr>
            <td class="col-article-id"></td>
            <td class="col-article-title"></td>
            <td class="col-article-typeId"></td>
            <td class="col-article-description"></td>
            <td>
                <button class="btn btn-danger delete-article" type="submit" data-articleid="">DELETE</button>
                <button type="button" class="btn btn-primary show-article" data-bs-toggle="modal" data-bs-target="#showArticleModal" data-articleid="">Show</button>
                <button type="button" class="btn btn-secondary edit-article" data-bs-toggle="modal" data-bs-target="#editArticleModal" data-articleid="">Edit</button>
            </td>
        </tr>
    </table>

</div>



<script>
    // Užklausos nustatymai (headeriai) ajax priėjimui prie serverio (analogas @csrf)
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {

        function createRowFromHtml(articleId, articleTitle, articleTypeId, articleDescription) {
            $(".template tr").addClass("article" + articleId);
            $(".template .delete-article").attr('data-articleid', articleId);
            $(".template .show-article").attr('data-articleid', articleId);
            $(".template .edit-article").attr('data-articleid', articleId);
            $(".template .col-article-id").html(articleId);
            $(".template .col-article-title").html(articleTitle);
            $(".template .col-article-typeId").html(articleTypeId);
            $(".template .col-article-description").html(articleDescription);

            return $(".template tbody").html();
        }

        //AJAX STORE DALIS:

        $("#submit-ajax-form").click(function() {
            //sukurti naujus kintamuosius
            let article_title;
            let article_typeId;
            let article_description;
            //užpildyti kintamuosius reikšmėmis iš nurodytų id input'ų
            article_title = $('#article_title').val();
            article_typeId = $('#article_typeId').val();
            article_description = $('#article_description').val();

            //užklausa į serverį
            $.ajax({
                type: 'POST', // nurodyti siuntimo metodą (POST, GET)
                url: '{{route("article.storeAjax")}}', // nurodyti action nuorodą
                //sukuriamas objektas su naujais kintamaisias
                //ar išsisiuntė sėkmingai, inspect>network>storeAjax>Headers (200 OK reiškia, kad išsisiuntė)
                data: {
                    article_title: article_title,
                    article_typeId: article_typeId,
                    article_description: article_description
                },
                // success atributas patikrina ar užklausa nuėjo į serverį t.y. ieško 200 OK
                // data kintamasis yra atsakymas t.y. ką gražina storeAjax metodas
                // inspect>network>storeAjax>Response
                success: function(data) {
                    // sėkmės atveju sukuriamas kintamasis html, kuris yra f-cijos grą-inama reikšmė
                    let html;
                    html = createRowFromHtml(data.articleId, data.articleTitle, data.articleTypeId, data.articleDescription);
                    // html kintamasis prisegamas prie pagrindinės lentelės
                    $("#articles-table").append(html);
                    $("#createArticleModal").hide();
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    $('body').css({
                        overflow: 'auto'
                    });
                    // #alert div padaromas matomu
                    $("#alert").removeClass("d-none");
                    $("#alert").html(data.articleTitle + " " + data.successMessage);
                    //ištuštinami inputų laukeliai 
                    $('#article_title').val('');
                    $('#article_typeId').val('');
                    $('#article_description').val('');
                }
            });
        });


        // DELETE AJAX dalis

        $(document).on('click', '.delete-article', function() {
            // naujas kintamasis, kuris bus id
            let articleid;
            //this mato kuris mygtukas buvo paspaustas ir pasiima jo id
            articleid = $(this).attr('data-articleid');
            //užklausa serveriui
            $.ajax({
                type: 'POST',
                url: '/articles/deleteAjax/' + articleid, // action kelias + id kintamasis
                success: function(data) {
                    // data yra return'as iš deleteAjax metodo
                    // ištrinama lentelės eilutė <tr> su klase article+id
                    $('.article' + articleid).remove();
                    // #alert div padaromas matomu
                    $("#alert").removeClass("d-none");
                    // į #alert įdedama žinutė iš data atsakymo objekto 
                    $("#alert").html(data.successMessage);
                }
            });
        });

        // SHOW AJAX dalis

        $(document).on('click', '.show-article', function() {
            let articleid;
            articleid = $(this).attr('data-articleid');
            $.ajax({
                type: 'GET',
                url: '/articles/showAjax/' + articleid,
                success: function(data) {
                    $('.show-article-id').html("Article id: " + data.articleId);
                    $('.show-article-title').html("Article title: " + data.articleTitle);
                    $('.show-article-typeId').html("Article type id: " + data.articleTypeId);
                    $('.show-article-description').html("Article description: " + data.articleDescription);
                }
            });
        });

        // EDIT UPDATE AJAX dalis 
        // edit atidaro modalą su su duomenimis (edit mygtukas)
        // updateAjax išsaugo db ir grąžina atnaujintus duomenis (update mygtukas modale)

        $(document).on('click', '.edit-article', function() {
            let articleid;
            articleid = $(this).attr('data-articleid');
            $.ajax({
                type: 'GET',
                //galima naudotis showAjax metodu, nes jis gražina duomenis apie pasirinktą id
                url: '/articles/showAjax/' + articleid,
                success: function(data) {
                    $('#edit_article_id').val(data.articleId);
                    $('#edit_article_title').val(data.articleTitle);
                    $('#edit_article_typeId').val(data.articleTypeId);
                    $('#edit_article_description').val(data.articleDescription);
                }
            });
        });


        $(document).on('click', '#update-article', function() {
            let articleid;
            let article_title;
            let article_typeId;
            let article_description;
            articleid = $('#edit_article_id').val();
            article_title = $('#edit_article_title').val();
            article_typeId = $('#edit_article_typeId').val();
            article_description = $('#edit_article_description').val();
            $.ajax({
                type: 'POST',
                url: '/articles/updateAjax/' + articleid,
                data: {
                    article_title: article_title,
                    article_typeId: article_typeId,
                    article_description: article_description
                },
                // sėkmės atveju pasirenkami atitinkamos article id klasės eilutės elementai ir jų reikšmė keičiama į naują
                success: function(data) {
                    $(".article" + articleid + " " + ".col-article-title").html(data.articleTitle)
                    $(".article" + articleid + " " + ".col-article-typeId").html(data.articleTypeId)
                    $(".article" + articleid + " " + ".col-article-description").html(data.articleDescription)

                    $("#alert").removeClass("d-none");
                    $("#alert").html(data.successMessage);

                    $("#editArticleModal").hide();
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    $('body').css({
                        overflow: 'auto'
                    });
                }
            });
        })
    })
</script>

@endsection