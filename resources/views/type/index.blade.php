@extends('layouts.app')

@section('content')

<div class="container">

    <h1>Type list</h1>

    <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#createTypeModal">
        Create New Type
    </button>

    <div id="alert" class="alert alert-success d-none mt-2">
    </div>



    <table id="types-table" class="table table-striped mt-2">
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        @foreach ($types as $type)
        <tr class="type{{$type->id}}">
            <td class="col-type-id">{{$type->id}}</td>
            <td class="col-type-title">{{$type->title}}</td>
            <td class="col-type-description">{{$type->description}}</td>
            <td>

                <button class="btn btn-danger delete-type" type="submit" data-typeid="{{$type->id}}">DELETE</button>
                <button type="button" class="btn btn-primary show-type" data-bs-toggle="modal" data-bs-target="#showTypeModal" data-typeid="{{$type->id}}">Show</button>
                <button type="button" class="btn btn-secondary edit-type" data-bs-toggle="modal" data-bs-target="#editTypeModal" data-typeid="{{$type->id}}">Edit</button>

            </td>
        </tr>
        @endforeach
    </table>

    <table class="template d-none">
        <tr>
            <td class="col-type-id"></td>
            <td class="col-type-title"></td>
            <td class="col-type-description"></td>
            <td>
                <button class="btn btn-danger delete-type" type="submit" data-typeid="">DELETE</button>
                <button type="button" class="btn btn-primary show-type" data-bs-toggle="modal" data-bs-target="#showTypeModal" data-typeid="">Show</button>
                <button type="button" class="btn btn-secondary edit-type" data-bs-toggle="modal" data-bs-target="#editTypeModal" data-typeid="">Edit</button>
            </td>
        </tr>
    </table>

</div>



<script>
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {

        function createRowFromHtml(typeId, typeTitle, typeDescription) {
            $(".template tr").addClass("type" + typeId);
            $(".template .delete-type").attr('data-typeid', typeId);
            $(".template .show-type").attr('data-typeid', typeId);
            $(".template .edit-type").attr('data-typeid', typeId);
            $(".template .col-type-id").html(typeId);
            $(".template .col-type-title").html(typeTitle);
            $(".template .col-type-description").html(typeDescription);

            return $(".template tbody").html();
        }

        
        $("#submit-ajax-form").click(function() {
            let type_title;
            let type_description;
            type_title = $('#type_title').val();
            type_description = $('#type_description').val();

            $.ajax({
                type: 'POST', 
                url: '{{route("type.storeAjax")}}',                
                data: {
                    type_title: type_title,
                    type_description: type_description
                },
                success: function(data) {
                    let html;
                    html = createRowFromHtml(data.typeId, data.typeTitle, data.typeDescription);
                    $("#types-table").append(html);
                    $("#createTypeModal").hide();
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    $('body').css({
                        overflow: 'auto'
                    });
                    $("#alert").removeClass("d-none");
                    $("#alert").html(data.typeTitle + " " + data.successMessage);
                    $('#type_title').val('');
                    $('#type_description').val('');
                }
            });
        });

        $(document).on('click', '.delete-type', function() {
            let typeid;
            typeid = $(this).attr('data-typeid');
            $.ajax({
                type: 'POST',
                url: '/types/deleteAjax/' + typeid, 
                success: function(data) {
                    $('.type' + typeid).remove();
                    $("#alert").removeClass("d-none");
                    $("#alert").html(data.successMessage);
                }
            });
        });

        $(document).on('click', '.show-type', function() {
            let typeid;
            typeid = $(this).attr('data-typeid');
            $.ajax({
                type: 'GET',
                url: '/types/showAjax/' + typeid,
                success: function(data) {
                    $('.show-type-id').html("Type id: " + data.typeId);
                    $('.show-type-title').html("Type title: " + data.typeTitle);
                    $('.show-type-description').html("Type description: " + data.typeDescription);
                }
            });
        });

        $(document).on('click', '.edit-type', function() {
            let typeid;
            typeid = $(this).attr('data-typeid');
            $.ajax({
                type: 'GET',
                url: '/types/showAjax/' + typeid,
                success: function(data) {
                    $('#edit_type_id').val(data.typeId);
                    $('#edit_type_title').val(data.typeTitle);
                    $('#edit_type_description').val(data.typeDescription);
                }
            });
        });


        $(document).on('click', '#update-type', function() {
            let typeid;
            let type_title;
            let type_description;
            typeid = $('#edit_type_id').val();
            type_title = $('#edit_type_title').val();
            type_description = $('#edit_type_description').val();
            $.ajax({
                type: 'POST',
                url: '/types/updateAjax/' + typeid,
                data: {
                    type_title: type_title,
                    type_description: type_description
                },
                success: function(data) {
                    $(".type" + typeid + " " + ".col-type-title").html(data.typeTitle)
                    $(".type" + typeid + " " + ".col-type-description").html(data.typeDescription)

                    $("#alert").removeClass("d-none");
                    $("#alert").html(data.successMessage);

                    $("#editTypeModal").hide();
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