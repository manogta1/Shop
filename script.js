function toggleForm(formId) {
    const form = document.getElementById(formId);
    form.classList.toggle('hidden');
}

function openEditForm(productId) {
    const editForm = document.getElementById('editProductForm_' + productId);
    editForm.classList.toggle('hidden');
}