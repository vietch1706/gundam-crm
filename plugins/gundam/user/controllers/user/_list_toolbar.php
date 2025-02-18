<div data-control="toolbar">
    <a
        href="<?= Backend::url('gundam/user/user/create') ?>"
        class="btn btn-primary oc-icon-plus">
        <?= e(trans('backend::lang.form.create')) ?>
    </a>
    <button
        class="btn btn-default oc-icon-trash-o"
        onclick="openDeleteModal()"
        data-list-checked-trigger>
        <?= e(trans('backend::lang.list.delete_selected')) ?>
    </button>
</div>

<!-- Modal nhập lý do xóa -->
<div id="deleteReasonModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal-alert-title-id-2" class="modal-title">Lý do xóa user</h5>
            </div>
            <div class="modal-body">
                <textarea id="deleteReasonInput" class="form-control" rows="3" placeholder="Nhập lý do..."></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="submitDelete()">Xác nhận</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>

<script>
    function openDeleteModal() {
        let selectedUsers = $('input[name="checked[]"]:checked').map(function () {
            return $(this).val();
        }).get();

        if (selectedUsers.length === 0) {
            alert('Vui lòng chọn user cần xóa!');
            return;
        }

        $('#deleteReasonModal').data('user-ids', selectedUsers).modal('show');
    }



    function submitDelete() {
        let userIds = $('#deleteReasonModal').data('user-ids'); // Lấy danh sách user đã chọn
        let reason = $('#deleteReasonInput').val();

        if (!userIds || userIds.length === 0) {
            alert('Vui lòng chọn user cần xóa!');
            return;
        }

        if (!reason.trim()) {
            alert('Vui lòng nhập lý do xóa!');
            return;
        }

        $.request('onDeleteUser', {
            data: {
                'user_ids': userIds, // Gửi dạng mảng
                'reason': reason
            },
            success: function(response) {
                $('#deleteReasonModal').modal('hide');
                location.reload();
            }
        });
    }

</script>
