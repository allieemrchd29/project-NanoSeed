<style>
    .nanoseed-footer {
        background-color: #04440f; 
        color: #f3f4f6;
        padding: 40px 20px 20px 20px;
        font-family: sans-serif;
        margin-top: auto; /
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
        color: #57f872; 
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
        margin-top: 40px;
        padding-top: 20px;
        border-top: 1px solid #374151;
        font-size: 0.85rem;
        color: #9ca3af;
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