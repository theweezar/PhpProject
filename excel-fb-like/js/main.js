function submitFormInsertPost() {
    $('body').on('click', 'button#submit-form-insert-post', function() {
        $('form#form-insert-post').trigger('submit');
    });

    $('body').on('submit', 'form#form-insert-post', function(e) {
        e.preventDefault();
        var self = $(this);
        var url = self.attr('action');

        console.log(self.prop('action'));
        console.log(self.serialize());

        $.ajax({
            type: 'POST',
            url: url,
            data: self.serialize()
        }).done(function(response) {
            var res = JSON.parse(response);
            console.log(res);
            self.prepend(`
                <div class="alert-section">
                    <div class="alert alert-${res.success ? 'success' : 'danger'} alert-dismissible fade show" role="alert">
                        ${res.message}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            `);
            $('input#postname').val('');
            $('input#postlink').val('');
            $('input#likes').val('');
            $('input#comments').val('');
            if (res.success && res.post) {
                var postTable = $('table#dataTable').DataTable();
                var post = res.post;
                postTable.row.add([
                    post.created_at,
                    post.postname,
                    `
                    <a target="_blank" class="link" href="${post.postlink}">
                        ${post.postlink}
                    </a>
                    `,
                    post.likes,
                    post.comments
                ]).draw( false );
            }
        }).fail(function() {
            self.prepend(`
                <div class="alert-section">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Có lỗi đã xảy ra. Vui lòng reload lại page hoặc liên hệ admin.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            `);
        });
    });
}

function activateCustomerPackage() {
    $('body').on('click', 'button#activate-btn', function() {
        var self = $(this);
        var url = self.data('url');
        var id = self.data('key');
        $.ajax({
            url: url,
            type: 'post',
            data: {id: id}
        }).done(function(response) {
            var res = JSON.parse(response);
            console.log(res);
            if (res.success) {
                $('td#likeAmount').text(res.likes);
                $('td#commentAmount').text(res.comments);
                $('button#success-alert-btn').trigger('click');
            }
        }).fail(function(error) {
            console.error(error.responseText);
        });
    });
}

function initHistoryTable() {
    $('#historyTable').DataTable({
        pageLength: 5,
        order: [[ 0, "desc" ]]
    });
}

function clickGoToCustomerDetailPage() {
    $('body').on('click', 'tr.customer-row', function () {
        var self = $(this);
        var customerUrl = self.data('url');
        window.location.href = customerUrl;
    });
}

function randomPassword() {
    var box = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz!!@@##$$%%^^&&--__++..";
    var password = "";
    for(var i = 0; i < 16; i++) {
        password += box.charAt(Math.floor(Math.random()*(box.length + 1 - 0) + 0));
    }
    return password;
}

function passwordGenerate() {
    $('body').on('click', 'input#passwordGenerate', function () {
        var password = randomPassword();
        
        var passwordInputRegister = $('input#password');
        var passwordInputChange = $('input#newpassword');
        
        if (passwordInputRegister && passwordInputRegister.length !== 0) {
            passwordInputRegister.attr('type', 'text');
            passwordInputRegister.val(password);
        }
        if (passwordInputChange && passwordInputChange.length !== 0) {
            passwordInputChange.attr('type', 'text');
            passwordInputChange.val(password);
        }
    });
}

const helpers = {
    clickGoToCustomerDetailPage: clickGoToCustomerDetailPage,
    activateCustomerPackage: activateCustomerPackage,
    initHistoryTable: initHistoryTable,
    passwordGenerate: passwordGenerate,
    submitFormInsertPost: submitFormInsertPost
};

$(function () {
    Object.keys(helpers).forEach(function(key) {
        var fn = helpers[key];
        if (typeof fn === 'function') {
            fn();
        }
    })
});