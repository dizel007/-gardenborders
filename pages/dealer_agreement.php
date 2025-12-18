<?php
session_start();
require_once "../header_styles.php";
?>
  <style>
    body {
        padding-top: 0;
    }
  </style>
    <div class="top-header">
        <div class="container">
            <div class="header-left">
                <div class="logo">
                    <i class="fas fa-leaf"></i>
                    <span>Garden<span class="logo-highlight">Borders</span></span>
                </div>
            </div>
        </div>
    </div>
<main class="container">
    <section class="hero" style="padding: 140px 0 60px;">
        <div class="container">
            <div class="hero-content">
                <h1>Договор публичной оферты</h1>
                <p class="hero-subtitle">Условия дилерского сотрудничества с GardenBorders</p>
            </div>
        </div>
    </section>

    <section class="about-section" style="margin-top: 60px;">
        <div class="section-header">
            <h2><i class="fas fa-file-contract"></i> Договор публичной оферты</h2>
            <p class="section-subtitle">Для дилеров и партнеров</p>
        </div>
        
        <div style="max-width: 900px; margin: 0 auto; background: white; padding: 40px; border-radius: var(--radius); box-shadow: var(--shadow);">
            <p style="text-align: center; margin-bottom: 30px; color: #666;">
                Полный текст договора отправляется после одобрения заявки на дилерство.
                Для получения договора заполните форму на странице 
                <a href="dealers.php" style="color: var(--primary-green); font-weight: 600;">Дилерство</a>.
            </p>
            
            <div style="text-align: center; margin-top: 40px;">
                <a href="dealers.php#dealer-form" class="cta-button" style="text-decoration: none;">
                    <i class="fas fa-user-tie"></i> Заполнить заявку на дилерство
                </a>
            </div>
        </div>
    </section>
</main>

