
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
    // Check if any radio button is selected
    var selectedReason = document.querySelector('input[name="reason"]:checked');

    if (!selectedReason) {
        alert('Please select a reason');
        return;
    }

    var customReason = document.getElementById('ufCustomReason').value;

    // If "Other" is selected, ensure a custom reason is provided
    if (selectedReason.value === 'other' && customReason.trim() === '') {
        alert('Please enter a custom reason');
        return;
    }

    // Submit the form
    document.getElementById('ufRejectForm').submit();
}
