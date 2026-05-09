<style>
    .nanoseed-footer {
        position: relative;
        color: #f3f4f6;
        padding: 11px;
        padding-bottom: 0;
        font-family: sans-serif;
        margin-top: auto; 
        overflow: hidden;
        background-image: url('http://localhost:8000/assets/img/imagenano.jpg');        
        background-size: cover;
        background-position: center;
    }
    .nanoseed-footer::before {
        content: '';
        position: absolute;
        inset: 0;
        background-color: rgba(4, 41, 10, 0.75); 
        z-index: 0;
    }
    .nanoseed-footer > * {
        position: relative;
        z-index: 1;
    }
    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        justify-content: space-between;
    }
    .footer-section {
        flex: 1;
        min-width: 250px; 
    }
    .footer-section h3 {
        color: #e7ece7; 
        margin-bottom: 15px;
        font-size: 1.2rem;
    }
    .footer-section p {
        line-height: 1.6;
        font-size: 0.95rem;
        color: #d1d5db;
        margin-bottom: 10px;
    }
    .sosmed-links a {
        display: inline-block;
        margin-right: 15px;
        color: #f3f7fc;
        text-decoration: none;
        font-size: 1.5rem;
        transition: color 0.3s;
    }
    .sosmed-links a:hover {
        color: #dae2db;
    }
    .footer-bottom {
        text-align: center;
        margin-top: 0;
        padding: 5px;
        paddinh-bottom: 0;
        font-size: 1.07rem;
        color:  #e8ebe8;
        background-color: transparent;
    }
</style>

<footer class="nanoseed-footer">
    <div class="footer-container">
        <div class="footer-section">
            <h3>Tentang NanoSeed</h3>
            <p>Membangun ekosistem teknologi yang inklusif dan inovatif. Kami berkomitmen untuk memberdayakan komunitas melalui solusi digital yang berdampak nyata bagi masyarakat.</p>
        </div>

        <div class="footer-section">
            <h3>Informasi Kontak</h3>
            <p>📍 Jl. Not Found No. 404, Kabupaten Purwakarta, Jawa Barat</p>
            <p>📞 +62 812-3456-7890-</p>
            <p>✉️ donasi@nanoseed.com</p>
        </div>

        <div class="footer-section">
            <h3>Temukan Kami</h3>
            <p>Kunjungi media sosial kami untuk update terbaru:</p>
            <div class="sosmed-links">
                <a href="#" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" title="Twitter"><i class="fa-brands fa-twitter"></i></a>                
                <a href="#" title="YouTube"><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>
    </div>
    
    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} NanoSeed. All rights reserved.</p>
    </div>
</footer>