<!-- Modal -->
<div class="modal fade show d-block" id="notification-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog rounded modal-dialog-centered">
      <div class="modal-content shadow border-0 rounded">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-bell"></i> Notification</h1>
          <button type="button" class="btn-close" id="modalButton1" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          {{ session('success') }}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="modalButton2" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>