document.addEventListener('DOMContentLoaded', function() {
    const profileUpload = document.getElementById('profile-upload');
    const submitBtn = document.getElementById('submit-btn');
    
    if (profileUpload && submitBtn) {
        profileUpload.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {

                // verification of the type
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                const fileType = this.files[0].type;
                
                // Verification of the size
                const maxFileSize = 2 * 1024 * 1024;
                
                if (!allowedTypes.includes(fileType)) {
                    alert('Seuls les fichiers JPEG, PNG et GIF sont autorisés.');
                    this.value = '';
                    return;
                }
                
                if (this.files[0].size > maxFileSize) {
                    alert('La taille maximale autorisée est de 2MB.');
                    this.value = '';
                    return;
                }
                
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const preview = document.querySelector('label[for="profile-upload"] img');
                    if (preview) {
                        preview.src = e.target.result;
                    }
                    submitBtn.classList.remove('hidden');
                }
                
                reader.readAsDataURL(this.files[0]);
            }
        });
    }
});