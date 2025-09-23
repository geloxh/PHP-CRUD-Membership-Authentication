function delete_item(id) {
    if (confirm("Are you sure you want to delete this item?")) {
        window.location.href = 'delete.php?id=' + id;
    }
}