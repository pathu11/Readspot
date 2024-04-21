
function openRejectModal() {
    document.getElementById('ufRejectModal').style.display = 'block';
}

function closeRejectModal() {
    document.getElementById('ufRejectModal').style.display = 'none';
}

function toggleCustomReason() {
    var customReason = document.getElementById('ufCustomReason');
    var otherRadio = document.querySelector('input[name="reason"][value="other"]');

    if (otherRadio.checked) {
        customReason.style.display = 'block';
    } else {
        customReason.style.display = 'none';
    }
}

function submitRejectReason() {
    var reason = document.querySelector('input[name="reason"]:checked').value;
    var customReason = document.getElementById('ufCustomReason').value;

    if (reason === 'other' && customReason.trim() === '') {
        alert('Please enter a custom reason');
        return;
    }

    document.getElementById('ufRejectForm').submit();
}