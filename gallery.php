<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery - Website Sederhana</title>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
    scroll-behavior: smooth;
}

/* Background Gradient - Light theme */
body {
    background: linear-gradient(120deg, #f5f7fa, #c3cfe2);
    color: #333;
    display: flex;
    flex-direction: column;
    align-items: center;
    min-height: 100vh;
}

/* Navbar Modern */
.navbar {
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(10px);
    padding: 15px 30px;
    border-radius: 12px;
    margin-top: 30px;
    display: inline-block;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    animation: fadeIn 0.8s ease-out;
}

.navbar a {
    color: #4a6fa5;
    text-decoration: none;
    margin: 0 20px;
    font-size: 16px;
    font-weight: 600;
    transition: all 0.3s ease;
    position: relative;
}

.navbar a:after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: -5px;
    left: 0;
    background-color: #4a6fa5;
    transition: width 0.3s ease;
}

.navbar a:hover {
    color: #2c3e50;
}

.navbar a:hover:after {
    width: 100%;
}

.container {
    text-align: center;
    margin-top: 50px;
    max-width: 1200px;
    width: 100%;
    padding: 0 20px;
}

h1 {
    font-size: 2.8rem;
    margin-bottom: 30px;
    color: #2c3e50;
    font-weight: 700;
    letter-spacing: -0.5px;
    animation: fadeIn 0.8s ease-out;
}

p {
    color: #5d6d7e;
    font-size: 1.1rem;
    margin-bottom: 40px;
    line-height: 1.8;
}

/* Gallery with grid layout - Lighter style */
.gallery {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 30px;
    justify-content: center;
}

.gallery-item {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    padding: 25px;
    border-radius: 16px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    animation: fadeInUp 1s ease-out;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.gallery-item:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
}

.gallery-item img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 12px;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.gallery-item img:hover {
    transform: scale(1.03);
}

.gallery-item h3 {
    margin-top: 15px;
    margin-bottom: 5px;
    color: #4a6fa5;
    font-weight: 600;
}

.gallery-item .date {
    font-size: 0.9rem;
    color: #7f8c8d;
    margin-bottom: 10px;
    display: block;
}

.gallery-item .description {
    margin-bottom: 15px;
    color: #5d6d7e;
    font-size: 1rem;
    line-height: 1.6;
}

.comment-count {
    color: #3498db;
    font-size: 0.9rem;
    cursor: pointer;
    display: inline-block;
    margin-top: 10px;
    transition: color 0.3s ease;
}

.comment-count:hover {
    color: #2980b9;
}

/* Modal box for image view and comments */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.6);
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes scaleIn {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
}

.modal-content {
    display: flex;
    flex-direction: column;
    background: rgba(255, 255, 255, 0.95);
    margin: 5% auto;
    padding: 30px;
    border-radius: 16px;
    width: 80%;
    max-width: 900px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    animation: scaleIn 0.5s ease;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.modal-title {
    font-size: 2rem;
    color: #2c3e50;
    font-weight: 700;
}

.close {
    color: #4a6fa5;
    font-size: 2rem;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

.close:hover {
    color: #2c3e50;
}

.modal-body {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.modal-image {
    max-width: 100%;
    max-height: 400px;
    object-fit: contain;
    border-radius: 12px;
    align-self: center;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

/* Comment Form */
.comment-section {
    margin-top: 20px;
    width: 100%;
}

.comment-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin-bottom: 20px;
}

.comment-form input,
.comment-form textarea {
    padding: 12px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    font-size: 1rem;
    background-color: rgba(255, 255, 255, 0.8);
    color: #333;
    transition: border 0.3s ease, box-shadow 0.3s ease;
}

.comment-form input:focus,
.comment-form textarea:focus {
    border-color: #4a6fa5;
    outline: none;
    box-shadow: 0 0 0 2px rgba(74, 111, 165, 0.2);
}

.comment-form input::placeholder,
.comment-form textarea::placeholder {
    color: #95a5a6;
}

.comment-form button {
    padding: 12px;
    background-color: #4a6fa5;
    color: #fff;
    border: none;
    border-radius: 10px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease;
}

.comment-form button:hover {
    background-color: #2c3e50;
    transform: translateY(-2px);
}

/* Comments styled like social media */
.comments {
    margin-top: 20px;
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.comment {
    display: flex;
    align-items: flex-start;
    background-color: rgba(240, 242, 245, 0.9);
    padding: 15px;
    border-radius: 12px;
    width: 100%;
    transition: transform 0.3s ease;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.comment:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}

.comment-avatar {
    width: 40px;
    height: 40px;
    background-color: #4a6fa5;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #fff;
    font-weight: bold;
    font-size: 18px;
    flex-shrink: 0;
    margin-right: 15px;
}

.comment-body {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    width: 100%;
}

.comment-header {
    display: flex;
    justify-content: space-between;
    width: 100%;
    margin-bottom: 5px;
}

.comment-name {
    font-weight: bold;
    color: #2c3e50;
}

.comment-date {
    font-size: 0.8rem;
    color: #7f8c8d;
}

.comment-text {
    color: #333;
    margin: 0;
    line-height: 1.5;
}

/* Responsive design */
@media (max-width: 600px) {
    .navbar {
        padding: 12px 15px;
    }
    .navbar a { 
        margin: 0 10px; 
        font-size: 14px; 
    }
    h1 { 
        font-size: 2.2rem; 
    }
    .container {
        padding: 30px 20px;
    }
    p { 
        font-size: 1rem; 
    }
    .gallery-item {
        padding: 15px;
    }
    .modal-content {
        width: 95%;
        padding: 20px;
    }
    .modal-title {
        font-size: 1.8rem;
    }
}
    </style>
</head>
<body>

    <div class="navbar">
        <a href="index.html">Home</a>
        <a href="gallery.php">Gallery</a>
        <a href="blog.html">Blog</a>
        <a href="contact.html">Contact</a>
    </div>

    <div class="container">
        <h1>Gallery</h1>
        <p>Klik pada gambar untuk melihat detail dan menambahkan komentar</p>

        <div class="gallery" id="gallery">
            <?php
            // Ambil data gambar dari database
            $query = "SELECT * FROM gambar ORDER BY tanggal_upload DESC";
            $result = pg_query($conn, $query);

            // Jika tidak ada tabel gambar atau hasil query, tampilkan gambar statis
            if (!$result || pg_num_rows($result) == 0) {
                $images = [
                    [
                        'id' => 1,
                        'judul' => 'boneka',
                        'deskripsi' => 'labubu',
                        'file_gambar' => 'labubu.jpg',
                        'tanggal_upload' => '2025-05-14'
                    ],
                    [
                        'id' => 2,
                        'judul' => 'Pantai',
                        'deskripsi' => 'Pemandangan pantai yang indah',
                        'file_gambar' => 'pantai.jpg',
                        'tanggal_upload' => '2025-05-13'
                    ],
                    [
                        'id' => 3,
                        'judul' => 'Riku',
                        'deskripsi' => 'Foto Riku',
                        'file_gambar' => 'riku.jpg',
                        'tanggal_upload' => '2025-05-12'
                    ],
                    [
                        'id' => 4,
                        'judul' => 'Christmas',
                        'deskripsi' => 'Suasana natal yang hangat',
                        'file_gambar' => 'WhatsApp Image 2024-12-12 at 21.22.19_89290de4.jpg',
                        'tanggal_upload' => '2025-05-11'
                    ]
                ];

                foreach ($images as $img) {
                    // Hitung jumlah komentar untuk gambar ini
                    $comment_query = "SELECT COUNT(*) as total FROM komentar WHERE id_gambar = " . $img['id'];
                    $comment_result = pg_query($conn, $comment_query);
                    $comment_count = 0;
                    
                    if ($comment_result) {
                        $comment_row = pg_fetch_assoc($comment_result);
                        $comment_count = $comment_row['total'];
                    }

                    echo '<div class="gallery-item" data-id="' . $img['id'] . '">';
                    echo '<img src="' . $img['file_gambar'] . '" alt="' . $img['judul'] . '">';
                    echo '<h3>' . $img['judul'] . '</h3>';
                    echo '<span class="date">' . date('d M Y', strtotime($img['tanggal_upload'])) . '</span>';
                    echo '<p class="description">' . $img['deskripsi'] . '</p>';
                    echo '<div class="comment-count" onclick="openModal(' . $img['id'] . ')">Komentar (' . $comment_count . ')</div>';
                    echo '</div>';
                }
            } else {
                // Tampilkan gambar dari database
                while ($row = pg_fetch_assoc($result)) {
                    // Hitung jumlah komentar untuk gambar ini
                    $comment_query = "SELECT COUNT(*) as total FROM komentar WHERE id_gambar = " . $row['id'];
                    $comment_result = pg_query($conn, $comment_query);
                    $comment_count = 0;
                    
                    if ($comment_result) {
                        $comment_row = pg_fetch_assoc($comment_result);
                        $comment_count = $comment_row['total'];
                    }

                    echo '<div class="gallery-item" data-id="' . $row['id'] . '">';
                    echo '<img src="' . $row['file_gambar'] . '" alt="' . $row['judul'] . '">';
                    echo '<h3>' . $row['judul'] . '</h3>';
                    echo '<span class="date">' . date('d M Y', strtotime($row['tanggal_upload'])) . '</span>';
                    echo '<p class="description">' . $row['deskripsi'] . '</p>';
                    echo '<div class="comment-count" onclick="openModal(' . $row['id'] . ')">Komentar (' . $comment_count . ')</div>';
                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>

    <!-- Modal untuk menampilkan gambar dan komentar -->
    <div id="imageModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">Judul Gambar</h2>
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-body">
                <img id="modalImage" class="modal-image" src="" alt="Gambar Detail">
                <p id="modalDescription" class="description"></p>
                
                <div class="comment-section">
                    <h3>Tambah Komentar</h3>
                    <form id="commentForm" class="comment-form">
                        <input type="hidden" id="imageId" name="imageId" value="">
                        <input type="text" id="commentName" name="nama" placeholder="Nama Anda" required>
                        <textarea id="commentText" name="komentar" placeholder="Tulis komentar Anda..." required></textarea>
                        <button type="submit" id="submitComment">Kirim Komentar</button>
                    </form>
                    
                    <h3>Komentar</h3>
                    <div id="commentsList" class="comments">
                        <!-- Komentar akan diisi via JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simpan elemen DOM yang sering digunakan
        const modal = document.getElementById('imageModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalImage = document.getElementById('modalImage');
        const modalDescription = document.getElementById('modalDescription');
        const commentForm = document.getElementById('commentForm');
        const imageIdInput = document.getElementById('imageId');
        const commentsList = document.getElementById('commentsList');
        
        // Tambahkan event listener ke semua item galeri
        document.querySelectorAll('.gallery-item').forEach(item => {
            item.addEventListener('click', function() {
                const imageId = this.getAttribute('data-id');
                openModal(imageId);
            });
        });
        
        // Fungsi untuk membuka modal dan menampilkan detail gambar beserta komentar
        function openModal(imageId) {
            // Cari item galeri yang sesuai
            const galleryItem = document.querySelector(`.gallery-item[data-id="${imageId}"]`);
            
            if (galleryItem) {
                // Dapatkan info gambar dari item galeri
                const image = galleryItem.querySelector('img');
                const title = galleryItem.querySelector('h3').textContent;
                const description = galleryItem.querySelector('.description').textContent;
                
                // Isi konten modal
                modalTitle.textContent = title;
                modalImage.src = image.src;
                modalImage.alt = title;
                modalDescription.textContent = description;
                
                // Set imageId untuk form komentar
                imageIdInput.value = imageId;
                
                // Muat komentar untuk gambar ini
                loadComments(imageId);
                
                // Tampilkan modal
                modal.style.display = 'block';
                
                // Mencegah scrolling di body saat modal terbuka
                document.body.style.overflow = 'hidden';
            }
        }
        
        // Fungsi untuk menutup modal
        function closeModal() {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
        
        // Tutup modal jika user mengklik di luar modal content
        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                closeModal();
            }
        });
        
        // Fungsi untuk memuat komentar dari server
        function loadComments(imageId) {
            // Bersihkan daftar komentar
            commentsList.innerHTML = '';
            
            // Buat AJAX request untuk mengambil komentar
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `get_comments.php?id_gambar=${imageId}`, true);
            
            xhr.onload = function() {
                if (this.status === 200) {
                    try {
                        const comments = JSON.parse(this.responseText);
                        
                        if (comments.length > 0) {
                            comments.forEach(comment => {
                                addCommentToDOM(comment);
                            });
                        } else {
                            commentsList.innerHTML = '<p>Belum ada komentar.</p>';
                        }
                    } catch (e) {
                        console.error('Error parsing JSON:', e);
                        commentsList.innerHTML = '<p>Error loading comments.</p>';
                    }
                }
            };
            
            xhr.onerror = function() {
                commentsList.innerHTML = '<p>Gagal memuat komentar.</p>';
            };
            
            xhr.send();
        }
        
        // Fungsi untuk menambahkan komentar ke DOM
        function addCommentToDOM(comment) {
            const initial = comment.nama.charAt(0).toUpperCase();
            const commentDate = new Date(comment.tanggal).toLocaleString('id-ID', {
                day: 'numeric',
                month: 'short',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
            
            const commentElement = document.createElement('div');
            commentElement.className = 'comment';
            commentElement.innerHTML = `
                <div class="comment-avatar">${initial}</div>
                <div class="comment-body">
                    <div class="comment-header">
                        <div class="comment-name">${comment.nama}</div>
                        <div class="comment-date">${commentDate}</div>
                    </div>
                    <p class="comment-text">${comment.komentar}</p>
                </div>
            `;
            
            commentsList.appendChild(commentElement);
        }
        
        // Fungsi untuk mengirim komentar
        commentForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const imageId = imageIdInput.value;
            const name = document.getElementById('commentName').value;
            const comment = document.getElementById('commentText').value;
            
            if (name.trim() === '' || comment.trim() === '') {
                alert('Silakan isi nama dan komentar Anda.');
                return;
            }
            
            // Buat FormData object untuk mengirim data
            const formData = new FormData();
            formData.append('imageId', imageId);
            formData.append('nama', name);
            formData.append('komentar', comment);
            formData.append('submit', 'true');
            
            // Kirim komentar via AJAX
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'save_comment.php', true);
            
            xhr.onload = function() {
                if (this.status === 200) {
                    // Reset form
                    document.getElementById('commentName').value = '';
                    document.getElementById('commentText').value = '';
                    
                    // Refresh komentar
                    loadComments(imageId);
                    
                    // Update jumlah komentar di thumbnail galeri
                    updateCommentCount(imageId);
                    
                    alert('Komentar berhasil ditambahkan!');
                } else {
                    alert('Gagal menambahkan komentar.');
                }
            };
            
            xhr.onerror = function() {
                alert('Terjadi kesalahan saat mengirim komentar.');
            };
            
            xhr.send(formData);
        });
        
        // Fungsi untuk memperbarui jumlah komentar di thumbnail
        function updateCommentCount(imageId) {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `get_comment_count.php?id_gambar=${imageId}`, true);
            
            xhr.onload = function() {
                if (this.status === 200) {
                    const count = parseInt(this.responseText);
                    const commentCountElement = document.querySelector(`.gallery-item[data-id="${imageId}"] .comment-count`);
                    
                    if (commentCountElement) {
                        commentCountElement.textContent = `Komentar (${count})`;
                    }
                }
            };
            
            xhr.send();
        }
        
        // Event listener untuk keyboard - tutup modal dengan Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.style.display === 'block') {
                closeModal();
            }
        });
    </script>
</body>
</html>