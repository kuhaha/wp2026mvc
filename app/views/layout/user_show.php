<h3>ユーザアカウント詳細</h3>
<table>
    <tr>
        <td width="20%">ユーザID</td><td><?= $user['uid']?></td>
    </tr>
    <tr>
        <td>氏名</th><td><?= $user['uname'] ?></td>
    </tr>
    <tr>
        <td>ユーザ種別</td><td><?= $user['urole'] ?></td>
    </tr>
</table>
<!-- Open Modal Button -->
<button class="open-modal-btn" id="openModalBtn">削除</button>

<!-- Modal Overlay -->
<div class="modal-overlay" id="modalOverlay">
    <!-- Modal Content -->
    <div class="modal">
        <span class="close-btn" id="closeModalBtn">&times;</span>
        <h2>削除確認</h2>
        <p><?= $user['uname'] ?>を本当に削除しますか？</p>
        <a class="open-modal-btn btn" href="<?= $_app_root_ ?>/u/delete/?id=<?= $user['uid'] ?>">削除</a>

    </div>
</div>

<style> 
    .btn {
        color: #aaa;
        float: right;
        border-radius: 6px;
    }
    /* Button styling */
    .open-modal-btn {
        padding: 5px 15px;
        font-size: 16px;
        cursor: pointer;
        background-color: #757579;
        color: white;
        border: none;
        border-radius: 6px;
        margin: 10px;
    }

    /* Modal overlay */
    .modal-overlay {
        display: none; /* Hidden by default */
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }

    /* Modal box */
    .modal {
        position: fixed;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        padding: 20px;
        width: 500px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        z-index: 1000;
    }

    /* Close button */
    .close-btn {
        float: right;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        color: #333;
    }
    .close-btn:hover {
        color: red;
    }
</style>



<script>
    // Get elements
    const openModalBtn = document.getElementById('openModalBtn');
    const modalOverlay = document.getElementById('modalOverlay');
    const closeModalBtn = document.getElementById('closeModalBtn');

    // Open modal
    openModalBtn.addEventListener('click', () => {
        modalOverlay.style.display = 'block';
    });

    // Close modal when clicking close button
    closeModalBtn.addEventListener('click', () => {
        modalOverlay.style.display = 'none';
    });

    // Close modal when clicking outside modal content
    modalOverlay.addEventListener('click', (e) => {
        if (e.target === modalOverlay) {
            modalOverlay.style.display = 'none';
        }
    });

    // Close modal with ESC key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            modalOverlay.style.display = 'none';
        }
    });
</script>
