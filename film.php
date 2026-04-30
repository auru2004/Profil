<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Film & Series — Ivan CNR</title>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@300;400;700&family=Syne:wght@400;700;800&family=Klee+One&display=swap" rel="stylesheet"/>
  <style>
    :root{--gold:#c9a84c;--muted:#7a6a52;--red:#c0392b;}
    *,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
    body{background:#0a0804;color:#f5efe6;font-family:'Syne',sans-serif;min-height:100vh;}
    nav{padding:1.5rem 2rem;display:flex;align-items:center;gap:1.5rem;border-bottom:1px solid rgba(201,168,76,0.1);}
    nav a{color:var(--muted);text-decoration:none;font-size:0.8rem;letter-spacing:0.2em;transition:color 0.2s;}
    nav a:hover{color:var(--gold);}
    .page-hero{padding:5rem 2rem 3rem;text-align:center;}
    .page-jp{font-family:'Noto Serif JP',serif;font-size:0.75rem;letter-spacing:0.5em;color:var(--muted);margin-bottom:0.5rem;}
    .page-icon{font-size:4rem;margin-bottom:1rem;filter:drop-shadow(0 0 20px #c0392b);}
    h1{font-size:clamp(2rem,6vw,4rem);font-weight:800;background:linear-gradient(135deg,#f5efe6,#e05744,#f5efe6);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
    .content{max-width:900px;margin:0 auto;padding:2rem;}
    .film-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 3rem; padding: 2rem 0; perspective: 1200px; }
    .film-card { position: relative; background: rgba(20, 25, 30, 0.4); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 12px; overflow: hidden; transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1); display: flex; flex-direction: column; backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px); box-shadow: 0 10px 30px -10px rgba(0,0,0,0.5); aspect-ratio: 2/3; }
    .film-card:hover { transform: translateY(-12px) scale(1.02); box-shadow: 0 20px 40px -5px rgba(0,0,0,0.7), 0 0 25px rgba(192,57,43,0.4), inset 0 0 0 1px rgba(201,168,76,0.2); border-color: transparent; }
    .film-cover { width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s ease, filter 0.8s ease; filter: brightness(0.85) contrast(1.1); }
    .film-card:hover .film-cover { transform: scale(1.08); filter: brightness(1.1) contrast(1.1); }
    .film-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(10, 8, 4, 0.95) 0%, rgba(10, 8, 4, 0.2) 50%, transparent 100%); display: flex; flex-direction: column; justify-content: flex-end; padding: 1.5rem; opacity: 1; transition: opacity 0.4s ease; z-index: 1; }
    .film-card:hover .film-overlay { background: linear-gradient(to top, rgba(192, 57, 43, 0.9) 0%, rgba(10, 8, 4, 0.4) 60%, transparent 100%); }
    .film-title { font-family: 'Syne', sans-serif; font-size: 1.25rem; font-weight: 800; color: rgba(245,239,230,0.95); line-height: 1.3; text-shadow: 0 2px 4px rgba(0,0,0,0.8); transition: color 0.3s; margin-bottom: 0.5rem; text-transform: capitalize; }
    .film-card:hover .film-title { color: var(--gold); }
    .film-rating { display: inline-flex; align-items: center; gap: 0.4rem; font-family: 'Klee One', cursive; font-size: 0.9rem; color: var(--gold); font-weight: bold; background: rgba(0,0,0,0.5); padding: 0.3rem 0.6rem; border-radius: 4px; backdrop-filter: blur(5px); border: 1px solid rgba(201,168,76,0.3); width: fit-content; text-shadow: 0 1px 2px rgba(0,0,0,0.8); }
    .film-card::before { content: ''; position: absolute; top: 0; left: -100%; width: 50%; height: 100%; background: linear-gradient(to right, transparent, rgba(255,255,255,0.1), transparent); transform: skewX(-25deg); transition: left 0.7s ease; z-index: 2; pointer-events: none; }
    .film-card:hover::before { left: 200%; }
    footer{text-align:center;padding:3rem;color:var(--muted);font-size:0.75rem;letter-spacing:0.3em;}
  </style>
</head>
<body>
  <nav>
    <a href="index.html">←</a>
    <a href="index.html">Home</a>
    <a href="buku.php">Buku</a>
    <a href="musik.html">Musik</a>
    <a href="anime.php">Anime</a>
    <a href="game.php">Game</a>
    <a href="projek.html">Projek</a>
  </nav>
  <div class="page-hero">
    <div class="page-jp">映画 · FILM & SERIES</div>
    <div class="page-icon">🎬</div>
    <h1>Film / Series</h1>
  </div>
  <div class="content">
    <div class="film-grid">
      <?php
        $films = glob("film/*.{jpg,jpeg,png,gif,webp}", GLOB_BRACE);
        
        if (count($films) > 0) {
            foreach ($films as $film) {
                $filename = pathinfo($film, PATHINFO_FILENAME);
                $parts = explode('_', $filename);
                $title = $parts[0];
                $rating = isset($parts[1]) ? $parts[1] : '?';
                
                echo '
                <div class="film-card">
                  <img src="' . htmlspecialchars($film) . '" alt="' . htmlspecialchars($title) . '" class="film-cover">
                  <div class="film-overlay">
                    <div class="film-title">' . htmlspecialchars($title) . '</div>
                    <div class="film-rating">★ ' . htmlspecialchars($rating) . '/10</div>
                  </div>
                </div>';
            }
        } else {
            echo '<p style="text-align: center; grid-column: 1 / -1; color: var(--red);">Belum ada film yang ditambahkan.</p>';
        }
      ?>
    </div>
  </div>
  <footer>映画 · Menjelajahi Berbagai Semesta</footer>
</body>
</html>
