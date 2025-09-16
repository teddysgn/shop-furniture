function changeStatus(url){
    $.get(url, function(data){
        var element		= 'a#status-' + data['id'];
        var classRemove = 'fa-solid fa-check';
        var classAdd 	= 'fa-solid fa-xmark';
        if(data['status']==1){
            classRemove = 'fa-solid fa-xmark';
            classAdd 	= 'fa-solid fa-check';
        }
        $(element).attr('href', "javascript:changeStatus('"+data['link']+"')");
        $(element + ' span').removeClass(classRemove).addClass(classAdd);
    }, 'json');
}

function changeSpecial(url){
    $.get(url, function(data){
        var element		= 'a#special-' + data['id'];
        var classRemove = 'fa-solid fa-check';
        var classAdd 	= 'fa-solid fa-xmark';
        if(data['special']==1){
            classRemove = 'fa-solid fa-xmark';
            classAdd 	= 'fa-solid fa-check';
        }
        $(element).attr('href', "javascript:changeSpecial('"+data['link']+"')");
        $(element + ' span').removeClass(classRemove).addClass(classAdd);
    }, 'json');
}

function changeCompleted(url){
    $.get(url, function(data){
        var element		= 'a#completed-' + data['id'];
        var classRemove = 'fa-solid fa-check';
        var classAdd 	= 'fa-solid fa-xmark';
        if(data['special']==1){
            classRemove = 'fa-solid fa-xmark';
            classAdd 	= 'fa-solid fa-check';
        }
        $(element).attr('href', "javascript:changeCompleted('"+data['link']+"')");
        $(element + ' span').removeClass(classRemove).addClass(classAdd);
    }, 'json');
}

function changeGroupACP(url){
    $.get(url, function(data){
        var element		= 'a#group-acp-' + data['id'];
        var classRemove = 'fa-solid fa-check';
        var classAdd 	= 'fa-solid fa-xmark';
        if(data['group_acp']==1){
            classRemove = 'fa-solid fa-xmark';
            classAdd 	= 'fa-solid fa-check';
        }
        $(element).attr('href', "javascript:changeGroupACP('"+data['link']+"')");
        $(element + ' span').removeClass(classRemove).addClass(classAdd);
    }, 'json');
}

function submitForm(url) {
    $('#adminForm').attr('action', url);
    $('#adminForm').submit();
}

function changePage(page){
    $('input[name=filter_page]').val(page);
    $('#adminForm').submit();
}

function sortList(column, order){
    $('input[name=filter_column]').val(column);
    $('input[name=filter_column_dir]').val(order);
    $('#adminForm').submit();
}



$(document).ready(function () {
    $('input[name=checkall]').change(function () {
        var checkStatus = this.checked;
        $('#adminForm').find(':checkbox').each(function () {
            this.checked = checkStatus;
        })
    });

    $('#adminForm button[name=submit-keyword]').click(function () {
        $('#adminForm').submit();
    });

    $('#filterForm button[name=btn-search]').click(function () {
        $('#filterForm').submit();
    });

    $('#adminForm button[name=clear-keyword]').click(function () {
        $('#adminForm input[name=filter_search]').val('');
        $('#adminForm').submit();
    });

    $('#adminForm select[name=filter_state]').change(function () {
        $('#adminForm').submit();
    });

    $('#adminForm select[name=filter_special]').change(function () {
        $('#adminForm').submit();
    });

    $('#adminForm select[name=filter_completed]').change(function () {
        $('#adminForm').submit();
    });

    $('#adminForm select[name=filter_group_acp]').change(function () {
        $('#adminForm').submit();
    });

    $('#adminForm select[name=filter_group_id]').change(function () {
        $('#adminForm').submit();
    });

    $('#adminForm select[name=filter_category_id]').change(function () {
        $('#adminForm').submit();
    });
    $('#adminForm input[type=checkbox]').click(function () {
        $('#adminForm').submit();
    });
    $('#adminForm input[type=radio]').click(function () {
        $('#adminForm').submit();
    });
})



