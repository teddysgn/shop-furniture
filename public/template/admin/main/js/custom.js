function changeStatus(url){
    $.get(url, function(data){
        var elementCompleted		= 'a#completed-' + data['id'];
        var elementStatus		    = 'a#status-' + data['id'];
        var classRemove = 'fa-solid fa-check';
        var classAdd 	= 'fa-solid fa-xmark';

        if(data['status'] == 1 && data['completed'] == 0) {
            var classRemove = 'fa-solid fa-check';
            var classAdd 	= 'fa-solid fa-xmark';
            $(elementCompleted + ' span').removeClass(classRemove).addClass(classAdd);
            $(elementStatus + ' span').removeClass(classRemove).addClass(classAdd);
            href="">
                $(elementCompleted).attr('href', "javascript:changeCompleted('index.php?module=admin&controller=order&action=ajaxCompleted&id=" + data['id'] + "&completed=0&user_id=" + data['user_id'] + "&status=0');");
            $(elementStatus).attr('href', "javascript:changeStatus('index.php?module=admin&controller=order&action=ajaxStatus&id=" + data['id'] + "&user_id=" + data['user_id'] + "&status=0&completed=0" + "')");
        }

        if(data['status'] == 0 && data['completed'] == 0) {
            var classRemove = 'fa-solid fa-xmark';
            var classAdd 	= 'fa-solid fa-check';
            $(elementCompleted + ' span').removeClass(classAdd).addClass(classRemove);
            $(elementStatus + ' span').removeClass(classRemove).addClass(classAdd);
            $(elementCompleted).attr('href', "javascript:changeCompleted('index.php?module=admin&controller=order&action=ajaxCompleted&id=" + data['id'] + "&completed=0&user_id=" + data['user_id'] + "&status=1');");
            $(elementStatus).attr('href', "javascript:changeStatus('index.php?module=admin&controller=order&action=ajaxStatus&id=" + data['id'] + "&user_id=" + data['user_id'] + "&status=1&completed=0" + "')");
        }


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
        var elementCompleted		= 'a#completed-' + data['id'];
        var elementStatus		    = 'a#status-' + data['id'];

        // 1 - 1
        if(data['status']== 1 && data['completed'] == 0) {
            console.log(data['status']);
            console.log(data['completed']);
            var classRemove             = 'fa-solid fa-xmark';
            var classAdd 	            = 'fa-solid fa-check opacity';
            $(elementCompleted + ' span').removeClass(classRemove).addClass(classAdd);
            $(elementStatus + ' span').removeClass(classRemove).addClass(classAdd);
            $(elementCompleted).attr('href', "");
            $(elementStatus).attr('href', "");
        }

        // 0 - 0
        if(data['status'] == 0 && data['completed']== 0){

            var classAdd                    = 'fa-solid fa-xmark';
            var classRemove 	            = 'fa-solid fa-check';
            $(elementCompleted + ' span').removeClass(classRemove).addClass(classAdd);
            $(elementStatus + ' span').removeClass(classAdd).addClass(classRemove);
            $(elementCompleted).attr('href', "javascript:changeCompleted('index.php?module=admin&controller=order&action=ajaxCompleted&user_id=" + data['user_id'] + "&id=" + data['id'] + "&status=1&completed=0" + "')");
            $(elementStatus).attr('href', "javascript:changeStatus('index.php?module=admin&controller=order&action=ajaxStatus&id=" + data['id'] + "&completed=0&user_id=" + data['user_id'] + "&status=1');");
        }
    }, 'json');
}

function changeGroupACP(url){
    $.get(url, function(data){
        var element		= 'a#group-acp-' + data['id'];
        if(data['group_acp'] == 0){
            classRemove = 'fa-solid fa-circle-dot';
            classAdd 	= 'fa-solid fa-xmark';
        }else if(data['group_acp'] == 1){
            classRemove = 'fa-solid fa-xmark';
            classAdd 	= 'fa-solid fa-check';
        }else if(data['group_acp'] == 2){
            classRemove = 'fa-solid fa-check';
            classAdd 	= 'fa-solid fa-circle-dot';
        }

        $(element).attr('href', "javascript:changeGroupACP('"+data['link']+"')");
        $(element + ' span').removeClass(classRemove).addClass(classAdd);
    }, 'json');
}

function changeCancel(url){
    $.get(url, function(data){
        var element		= 'a#cancel-' + data['id'];
        
        classRemove 	= 'fa-solid fa-circle-dot';
        classAdd        = 'fa-solid fa-check opacity';
        
        
        $(element).attr('href', "javascript:changeCancel('"+data['link']+"')");
        $(element).removeClass(classRemove).addClass(classAdd);
        // $(element).attr('class', classAdd);
    }, 'json');
}

function changeOther(url){
    $.get(url, function(data){
        var element		= 'a#status-' + data['id'];
        var classRemove = 'fa-solid fa-check';
        var classAdd 	= 'fa-solid fa-xmark';
        if(data['status'] == 1){
            classRemove = 'fa-solid fa-xmark';
            classAdd 	= 'fa-solid fa-check';
        }
        $(element).attr('href', "javascript:changeOther('"+data['link']+"')");
        $(element + ' span').removeClass(classRemove).addClass(classAdd);
    }, 'json');
}

function submitForm(url) {
    $('#adminForm').attr('action', url);
    $('#adminForm').submit();
}

function sortList(column, order){
    $('input[name=filter_column]').val(column);
    $('input[name=filter_column_dir]').val(order);
    $('#adminForm').submit();
}

function changePage(page){
    $('input[name=filter_page]').val(page);
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

    $('#adminForm button[name=clear-keyword]').click(function () {
        $('#adminForm input[name=filter_search]').val('');
        $('#adminForm').submit();
    });

    $('#adminForm select[name=filter_state]').change(function () {
        $('#adminForm').submit();
    });
    
    $('#adminForm select[name=filter_cancel]').change(function () {
        $('#adminForm').submit();
    });

    $('#adminForm select[name=filter_special]').change(function () {
        $('#adminForm').submit();
    });

    $('#adminForm select[name=filter_method]').change(function () {
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

    $('#adminForm select[name=filter_collection_id]').change(function () {
        $('#adminForm').submit();
    });

    $('#adminForm select[name=filter_designer_id]').change(function () {
        $('#adminForm').submit();
    });
    
    $('#adminForm select[name=filter_trash]').change(function () {
        $('#adminForm').submit();
    });

    $('#adminForm input[type=radio]').click(function () {
        $('#adminForm').submit();
    });


})

