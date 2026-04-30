<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Game — Ivan CNR</title>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@300;400;700&family=Syne:wght@400;700;800&family=Klee+One&family=Orbitron:wght@500;700;900&display=swap" rel="stylesheet"/>
  <style>
    :root {
      --gold: #c9a84c;
      --muted: #7a6a52;
      --cyan: #00f3ff;
      --magenta: #bc13fe;
      --dark-bg: #050508;
    }

    *, *::before, *::after {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background: var(--dark-bg);
      color: #f5efe6;
      font-family: 'Syne', sans-serif;
      min-height: 100vh;
      overflow-x: hidden;
      background-image: 
        linear-gradient(rgba(0, 243, 255, 0.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0, 243, 255, 0.03) 1px, transparent 1px);
      background-size: 30px 30px;
    }

    nav {
      padding: 1.5rem 2rem;
      display: flex;
      align-items: center;
      gap: 1.5rem;
      border-bottom: 1px solid rgba(0, 243, 255, 0.1);
      background: rgba(5, 5, 8, 0.8);
      backdrop-filter: blur(10px);
      position: relative;
      z-index: 10;
    }

    nav a {
      color: var(--muted);
      text-decoration: none;
      font-size: 0.8rem;
      letter-spacing: 0.2em;
      transition: all 0.3s ease;
      text-transform: uppercase;
      font-family: 'Orbitron', sans-serif;
    }

    nav a:hover {
      color: var(--cyan);
      text-shadow: 0 0 8px var(--cyan);
    }

    .page-hero {
      padding: 5rem 2rem 3rem;
      text-align: center;
      position: relative;
    }

    .page-jp {
      font-family: 'Noto Serif JP', serif;
      font-size: 0.75rem;
      letter-spacing: 0.5em;
      color: var(--cyan);
      margin-bottom: 0.5rem;
      opacity: 0.8;
    }

    .page-icon {
      font-size: 4rem;
      margin-bottom: 1rem;
      filter: drop-shadow(0 0 20px var(--cyan));
      animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }

    h1 {
      font-family: 'Orbitron', sans-serif;
      font-size: clamp(2.5rem, 6vw, 4.5rem);
      font-weight: 900;
      color: #fff;
      text-shadow: 
        0 0 5px #fff,
        0 0 10px #fff,
        0 0 20px var(--cyan),
        0 0 40px var(--cyan),
        0 0 80px var(--cyan);
      letter-spacing: 0.1em;
      text-transform: uppercase;
    }

    .content {
      max-width: 1200px;
      margin: 0 auto;
      padding: 2rem;
    }

    .game-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 2.5rem;
      padding: 2rem 0;
    }

    .game-card {
      position: relative;
      background: rgba(10, 10, 15, 0.6);
      border: 1px solid rgba(0, 243, 255, 0.2);
      border-radius: 4px;
      overflow: hidden;
      aspect-ratio: 3/4;
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      cursor: pointer;
    }

    .game-card::before {
      content: '';
      position: absolute;
      top: 0; left: -100%;
      width: 50%; height: 100%;
      background: linear-gradient(to right, transparent, rgba(0, 243, 255, 0.2), transparent);
      transform: skewX(-25deg);
      transition: left 0.7s ease;
      z-index: 2;
    }

    .game-card:hover {
      transform: translateY(-10px) scale(1.03);
      border-color: var(--cyan);
      box-shadow: 
        0 15px 35px rgba(0,0,0,0.5),
        0 0 20px rgba(0, 243, 255, 0.3),
        inset 0 0 15px rgba(0, 243, 255, 0.2);
    }

    .game-card:hover::before {
      left: 200%;
    }

    .game-cover {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: all 0.5s ease;
      filter: grayscale(20%) brightness(0.8) contrast(1.1);
    }

    .game-card:hover .game-cover {
      filter: grayscale(0%) brightness(1.1) contrast(1.2);
      transform: scale(1.05);
    }

    .game-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(to top, rgba(5,5,8, 0.95) 0%, rgba(5,5,8, 0.4) 40%, transparent 100%);
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      padding: 1.5rem;
      z-index: 1;
      border-bottom: 3px solid transparent;
      transition: all 0.3s ease;
    }

    .game-card:hover .game-overlay {
      border-bottom: 3px solid var(--cyan);
      background: linear-gradient(to top, rgba(0, 243, 255, 0.15) 0%, rgba(5,5,8, 0.6) 50%, transparent 100%);
    }

    .game-title {
      font-family: 'Orbitron', sans-serif;
      font-size: 1.1rem;
      font-weight: 700;
      color: #fff;
      line-height: 1.3;
      text-shadow: 0 2px 4px rgba(0,0,0,0.8);
      transition: color 0.3s;
      margin-bottom: 0.3rem;
      letter-spacing: 0.05em;
    }

    .game-card:hover .game-title {
      color: var(--cyan);
      text-shadow: 0 0 10px rgba(0, 243, 255, 0.8);
    }

    footer {
      text-align: center;
      padding: 3rem;
      color: var(--muted);
      font-size: 0.75rem;
      letter-spacing: 0.3em;
      border-top: 1px solid rgba(0, 243, 255, 0.1);
      margin-top: 3rem;
    }
  </style>
</head>
<body>
  <nav>
    <a href="index.html">←</a>
    <a href="index.html">Home</a>
    <a href="buku.php">Buku</a>
    <a href="musik.html">Musik</a>
    <a href="film.php">Film</a>
    <a href="anime.php">Anime</a>
    <a href="projek.html">Projek</a>
  </nav>

  <div class="page-hero">
    <div class="page-jp">ゲーム · GAMES</div>
    <div class="page-icon">🎮</div>
    <h1>Game</h1>
  </div>

  <div class="content">
    <div class="game-grid">
      <?php
        // Otomatis membaca semua file gambar di folder 'game/'
        $games = glob("game/*.{jpg,jpeg,png,gif,webp}", GLOB_BRACE);
        
        if (count($games) > 0) {
            foreach ($games as $game) {
                // Mendapatkan nama file tanpa ekstensi untuk dijadikan judul
                $filename = pathinfo($game, PATHINFO_FILENAME);
                
                echo '
                <div class="game-card">
                  <img src="' . htmlspecialchars($game) . '" alt="' . htmlspecialchars($filename) . '" class="game-cover">
                  <div class="game-overlay">
                    <div class="game-title">' . htmlspecialchars($filename) . '</div>
                  </div>
                </div>';
            }
        } else {
            echo '<p style="text-align: center; grid-column: 1 / -1; color: var(--cyan); font-family: Orbitron;">Belum ada game yang ditambahkan.</p>';
        }
      ?>
    </div>
  </div>

  <footer>ゲーム · LEVEL UP YOUR LIFE</footer>
</body>
</html>
