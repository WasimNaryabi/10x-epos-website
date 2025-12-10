<template>
    <footer class="footer">
        <div class="footer-content">
            <!-- Company Info -->
            <div class="footer-section company-info">
                <div class="footer-logo">
                    <img src="/images/10x-global-logo.png" alt="10x Global EPOS" class="footer-logo-img" />
                </div>
                <p>
                    The complete point of sale solution for modern restaurants and cafes. 
                    Streamline operations, boost sales, and delight customers.
                </p>
                <div class="social-links">
                    <a href="#" aria-label="Facebook">
                        <Icon name="facebook" :size="20" color="currentColor" />
                    </a>
                    <a href="#" aria-label="Twitter">
                        <Icon name="twitter" :size="20" color="currentColor" />
                    </a>
                    <a href="#" aria-label="LinkedIn">
                        <Icon name="linkedin" :size="20" color="currentColor" />
                    </a>
                    <a href="#" aria-label="Instagram">
                        <Icon name="instagram" :size="20" color="currentColor" />
                    </a>
                    <a href="#" aria-label="YouTube">
                        <Icon name="youtube" :size="20" color="currentColor" />
                    </a>
                </div>
            </div>

            <!-- Product Links -->
            <div class="footer-section">
                <h3>Product</h3>
                <ul>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#pricing">Pricing</a></li>
                    <li><a href="#product">Product Demo</a></li>
                    <li><a href="#">What's New</a></li>
                </ul>
            </div>

            <!-- Company Links -->
            <div class="footer-section">
                <h3>Company</h3>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#partners">Partners</a></li>
                    <li><a href="#">Press Kit</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>

            <!-- Support Links -->
            <div class="footer-section">
                <h3>Support</h3>
                <ul>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Documentation</a></li>
                    <li><a href="#">Video Tutorials</a></li>
                    <li><a href="#">Community Forum</a></li>
                    <li><a href="#">System Status</a></li>
                    <li><a href="#">Contact Support</a></li>
                </ul>
            </div>

            <!-- Legal Links -->
            <div class="footer-section">
                <h3>Legal</h3>
                <ul>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Cookie Policy</a></li>
                    <li><a href="#">GDPR Compliance</a></li>
                    <li><a href="#">Security</a></li>
                    <li><a href="#">Acceptable Use</a></li>
                </ul>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <p>&copy; {{ currentYear }} 10x Global EPOS. All rights reserved. Built with ❤️ for restaurants worldwide.</p>
        </div>
    </footer>
</template>

<script setup>
import { computed } from 'vue';
import Icon from '@/Components/Shared/Icon.vue';

const currentYear = computed(() => new Date().getFullYear());
</script>

<style scoped>
.footer {
    background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
    color: white;
    padding: 4rem 2rem 2rem;
}

.footer-content {
    max-width: 1400px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr 1fr;
    gap: 3rem;
    margin-bottom: 3rem;
}

.footer-section h3 {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    color: white;
}

.footer-logo {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.footer-logo-img {
    height: 120px;
    width: auto;
    object-fit: contain;
}

.company-info h3 {
    margin-bottom: 0;
}

.footer-section p {
    color: #cbd5e1;
    line-height: 1.8;
    margin-bottom: 1.5rem;
}

.footer-section ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-section ul li {
    margin-bottom: 0.75rem;
}

.footer-section ul li a {
    color: #cbd5e1;
    text-decoration: none;
    transition: color 0.3s;
    font-size: 0.95rem;
}

.footer-section ul li a:hover {
    color: #667eea;
}

.social-links {
    display: flex;
    gap: 1rem;
}

.social-links a {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    transition: all 0.3s;
}

.social-links a:hover {
    background: linear-gradient(135deg, #667eea, #764ba2);
    transform: translateY(-3px);
}

.footer-bottom {
    max-width: 1400px;
    margin: 0 auto;
    padding-top: 2rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    text-align: center;
}

.footer-bottom p {
    color: #94a3b8;
    font-size: 0.9rem;
}

@media (max-width: 1024px) {
    .footer-content {
        grid-template-columns: repeat(3, 1fr);
    }

    .footer-section:first-child {
        grid-column: 1 / -1;
    }
}

@media (max-width: 768px) {
    .footer {
        padding: 3rem 1.5rem 2rem;
    }

    .footer-content {
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    .footer-section:first-child {
        grid-column: auto;
    }
}
</style>