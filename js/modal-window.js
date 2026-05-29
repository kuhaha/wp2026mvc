document.addEventListener('DOMContentLoaded', () => {
    modalTriggers();
});
function modalTriggers() {
    const openButtons = document.querySelectorAll('.open-modal');
    const closeButtons = document.querySelectorAll('.close-btn');
    const modals = document.querySelectorAll('.modal');


    openButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modalId = button.dataset.modal;
            openModal(modalId);
        });
    });


    closeButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modalId = button.dataset.modal;
            closeModal(modalId);
        });
    });


    //モーダルの背景クリックで閉じる
    modals.forEach(modal => {
        modal.addEventListener('click', e => {
            if (e.target.classList.contains('modal')) {
                modal.classList.remove('active');
            }
        });
    });
}


//指定したIDのモーダルを開く関数
function openModal(modalId) {
    const modal = document.getElementById(`modal-${modalId}`);
    if (modal) {
        modal.classList.add('active');
    }
}


//指定したIDのモーダルを閉じる関数
function closeModal(modalId) {
    const modal = document.getElementById(`modal-${modalId}`);
    if (modal) {
        modal.classList.remove('active');
    }
}