<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Pourquoi déjà ?</title>
<meta name="description" content="Petites histoires des conventions du code : d'où viennent le préfixe X-, le mot daemon, le code 404 et quelques dizaines d'autres.">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
<style>
:root{
  --bg:#fff; --bg2:#fff; --tx:#0d0d0d; --tx2:#4a4a4a; --tx3:#9a9a9a;
  --rule:#0d0d0d; --hair:#e2e2e2; --ac:#d8432c;
  --sans:"Inter",system-ui,-apple-system,"Segoe UI",sans-serif;
  --mono:"JetBrains Mono",ui-monospace,SFMono-Regular,Menlo,monospace;
}
@media (prefers-color-scheme: dark){:root:not([data-theme="light"]){
  --bg:#0c0c0c; --bg2:#141414; --tx:#f2f0ec; --tx2:#b3afa8; --tx3:#6d6a65;
  --rule:#f2f0ec; --hair:#2a2a2a; --ac:#ff6a4d;
}}
:root[data-theme="dark"]{
  --bg:#0c0c0c; --bg2:#141414; --tx:#f2f0ec; --tx2:#b3afa8; --tx3:#6d6a65;
  --rule:#f2f0ec; --hair:#2a2a2a; --ac:#ff6a4d;
}
*{box-sizing:border-box}
html{-webkit-text-size-adjust:100%}
body{margin:0;background:var(--bg);color:var(--tx);font-family:var(--sans);line-height:1.5;
  -webkit-font-smoothing:antialiased;font-size:16px}
.wrap{max-width:1040px;margin:0 auto;padding:0 16px 72px}
@media(min-width:700px){.wrap{padding:0 32px 90px}}

/* en-tête */
header{padding:38px 0 0}
.kick{font-family:var(--mono);font-size:10px;letter-spacing:.18em;text-transform:uppercase;
  color:var(--ac);margin:0 0 16px}
h1{font-size:clamp(44px,13vw,96px);font-weight:800;letter-spacing:-.045em;line-height:.92;margin:0}
h1 span{color:var(--ac)}
.lede{max-width:30em;color:var(--tx2);font-size:15.5px;margin:18px 0 0}
@media(min-width:700px){.lede{font-size:17px}}

/* commandes */
.bar{display:flex;gap:10px;margin:26px 0 14px;flex-wrap:wrap}
.search{flex:1 1 220px;display:flex;align-items:center;gap:10px;
  border:1.5px solid var(--rule);padding:0 13px;background:var(--bg2)}
.search svg{flex:none;opacity:.5}
.search input{flex:1;min-width:0;border:0;background:none;outline:none;color:var(--tx);
  font-family:var(--mono);font-size:13px;padding:12px 0}
.search input::placeholder{color:var(--tx3)}
.btn{font-family:var(--mono);font-size:10.5px;letter-spacing:.1em;text-transform:uppercase;
  background:var(--rule);color:var(--bg);border:0;padding:0 18px;cursor:pointer;white-space:nowrap}
.btn:active{transform:translateY(1px)}
.chips{display:flex;gap:6px;flex-wrap:wrap;margin-bottom:6px}
.chip{font-family:var(--mono);font-size:10.5px;padding:6px 11px;border:1px solid var(--hair);
  background:none;color:var(--tx2);cursor:pointer}
.chip[aria-pressed="true"]{background:var(--ac);border-color:var(--ac);color:#fff}
.count{font-family:var(--mono);font-size:10.5px;color:var(--tx3);margin:16px 0 0;
  border-bottom:2px solid var(--rule);padding-bottom:8px}

/* liste */
.grid{display:grid;grid-template-columns:1fr}
@media(min-width:760px){.grid{grid-template-columns:1fr 1fr;column-gap:40px}}
.card{display:grid;grid-template-columns:34px 1fr;gap:12px;width:100%;text-align:left;
  border:0;border-bottom:1px solid var(--hair);background:none;color:inherit;font:inherit;
  padding:17px 0 19px;cursor:pointer}
.card:hover .term{color:var(--ac)}
.card .num{font-family:var(--mono);font-size:10.5px;color:var(--tx3);padding-top:6px}
.card .cat{font-size:9.5px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--ac)}
.card .term{font-size:23px;font-weight:800;letter-spacing:-.035em;line-height:1.08;
  margin:6px 0 7px;word-break:break-word;transition:color .12s}
@media(min-width:700px){.card .term{font-size:26px}}
.card .tea{font-size:14px;color:var(--tx2);margin:0;line-height:1.45}
.card .dt{font-family:var(--mono);font-size:10px;color:var(--tx3);margin-top:10px}
.vide{font-family:var(--mono);font-size:13px;color:var(--tx2);padding:34px 0}

/* fiche */
.scrim{position:fixed;inset:0;background:rgba(0,0,0,.5);opacity:0;pointer-events:none;
  transition:opacity .18s;z-index:40}
.scrim.on{opacity:1;pointer-events:auto}
.sheet{position:fixed;z-index:50;background:var(--bg);left:0;right:0;bottom:0;
  max-height:92vh;overflow-y:auto;border-top:4px solid var(--ac);
  transform:translateY(102%);transition:transform .26s cubic-bezier(.2,.8,.3,1);
  padding:26px 18px 46px}
.sheet.on{transform:translateY(0)}
@media(min-width:760px){
  .sheet{left:50%;right:auto;bottom:auto;top:50%;width:min(640px,92vw);padding:34px 38px 44px;
    transform:translate(-50%,-45%);opacity:0;transition:opacity .18s,transform .18s}
  .sheet.on{transform:translate(-50%,-50%);opacity:1}
}
.sheet .fermer{position:absolute;top:14px;right:14px;width:30px;height:30px;line-height:1;
  border:1px solid var(--hair);background:none;color:var(--tx2);cursor:pointer;font-size:13px}
.sheet .cat{font-size:9.5px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--ac)}
.sheet h2{font-size:34px;font-weight:800;letter-spacing:-.04em;line-height:1.02;margin:9px 0 6px;
  word-break:break-word}
@media(min-width:760px){.sheet h2{font-size:42px}}
.sheet .dt{font-family:var(--mono);font-size:11px;color:var(--tx3);
  border-bottom:2px solid var(--rule);padding-bottom:14px;margin-bottom:20px}
.sheet p.r{font-size:15.5px;margin:0 0 15px;color:var(--tx)}
@media(min-width:760px){.sheet p.r{font-size:16.5px}}
.sheet code{font-family:var(--mono);font-size:.88em;background:var(--bg2);
  border:1px solid var(--hair);padding:1px 4px}
.retenir{font-size:21px;font-weight:700;letter-spacing:-.025em;line-height:1.22;
  border-top:3px solid var(--rule);padding-top:14px;margin:24px 0 0}
@media(min-width:760px){.retenir{font-size:25px}}
.aujourdhui{margin-top:22px;border-left:3px solid var(--ac);padding:2px 0 2px 15px}
.aujourdhui b{display:block;font-size:9.5px;font-weight:700;letter-spacing:.14em;
  text-transform:uppercase;color:var(--ac);margin-bottom:6px}
.aujourdhui p{margin:0;font-size:14.5px;color:var(--tx2)}
.voir{margin-top:24px;display:flex;gap:7px;flex-wrap:wrap;align-items:center}
.voir span{font-family:var(--mono);font-size:9.5px;letter-spacing:.12em;text-transform:uppercase;color:var(--tx3)}
.voir button{font-family:var(--mono);font-size:11px;border:1px solid var(--hair);background:none;
  color:var(--tx);padding:6px 10px;cursor:pointer}

footer{border-top:1px solid var(--hair);margin-top:46px;padding-top:20px;
  font-family:var(--mono);font-size:10.5px;color:var(--tx3)}
</style>
</head>
<body>
<div class="wrap">
  <header>
    <p class="kick">petites histoires des conventions du code</p>
    <h1>Pourquoi<br><span>déjà ?</span></h1>
    <p class="lede">Un préfixe, un mot bizarre, un nombre qu'on tape sans le lire. Une fiche = une minute, et la moitié contredit ce qu'on raconte d'habitude.</p>

    <div class="bar">
      <label class="search">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="7"/><path d="M20 20l-4-4"/></svg>
        <input id="q" type="search" placeholder="daemon, 404, kanban…" autocomplete="off">
      </label>
      <button class="btn" id="hasard">au hasard</button>
    </div>
    <div class="chips" id="chips"></div>
  </header>

  <p class="count" id="count"></p>
  <div class="grid" id="grid"></div>

  <footer>{{ count($fiches) }} fiches. Chacune&nbsp;: le contexte, l'anecdote, et ce qu'il en reste dans le code d'aujourd'hui.</footer>
</div>

<div class="scrim" id="scrim"></div>
<article class="sheet" id="sheet" role="dialog" aria-modal="true"></article>

<script>
const F = {!! $json !!};
const CATS = ["Tout", ...@json($categories)];
let cat = "Tout", q = "";

const $ = s => document.querySelector(s);
const grid = $("#grid"), chips = $("#chips"), sheet = $("#sheet"), scrim = $("#scrim");

chips.innerHTML = CATS.map(c => `<button class="chip" data-c="${c}" aria-pressed="${c === cat}">${c}</button>`).join("");
chips.onclick = e => {
  const b = e.target.closest(".chip"); if (!b) return;
  cat = b.dataset.c;
  [...chips.children].forEach(x => x.setAttribute("aria-pressed", x.dataset.c === cat));
  rendre();
};
$("#q").oninput = e => { q = e.target.value.toLowerCase().trim(); rendre(); };

const texte = f => (f.terme + " " + f.teaser + " " + f.recit.join(" ") + " " + f.categorie + " " + f.aujourdhui).toLowerCase();
const filtrees = () => F.filter(f => (cat === "Tout" || f.categorie === cat) && (!q || texte(f).includes(q)));

function rendre() {
  const l = filtrees();
  $("#count").textContent = l.length ? `${String(l.length).padStart(2, "0")} fiche${l.length > 1 ? "s" : ""}` : "";
  grid.innerHTML = l.length ? l.map(f => `
    <button class="card" data-s="${f.slug}">
      <div class="num">${String(f.ordre).padStart(2, "0")}</div>
      <div>
        <span class="cat">${f.categorie}</span>
        <div class="term">${f.terme}</div>
        <p class="tea">${f.teaser}</p>
        <div class="dt">${f.date}</div>
      </div>
    </button>`).join("")
    : `<p class="vide">Rien pour « ${q} ». C'est peut-être une fiche à écrire.</p>`;
}
grid.onclick = e => { const c = e.target.closest(".card"); if (c) ouvrir(c.dataset.s); };

const voisines = f => F.filter(x => x.slug !== f.slug && x.categorie === f.categorie).slice(0, 2);

function ouvrir(slug) {
  const f = F.find(x => x.slug === slug); if (!f) return;
  sheet.innerHTML = `
    <button class="fermer" aria-label="Fermer">✕</button>
    <span class="cat">${f.categorie}</span>
    <h2>${f.terme}</h2>
    <div class="dt">${f.date} · fiche ${String(f.ordre).padStart(2, "0")}</div>
    ${f.recit.map(p => `<p class="r">${p}</p>`).join("")}
    <p class="retenir">${f.retenir}</p>
    <div class="aujourdhui"><b>Ce qu'il en reste</b><p>${f.aujourdhui}</p></div>
    <div class="voir"><span>voir aussi</span>${voisines(f).map(v => `<button data-go="${v.slug}">${v.terme}</button>`).join("")}</div>`;
  sheet.classList.add("on"); scrim.classList.add("on");
  sheet.scrollTop = 0;
  document.body.style.overflow = "hidden";
  history.replaceState(null, "", "#" + slug);
}
function fermer() {
  sheet.classList.remove("on"); scrim.classList.remove("on");
  document.body.style.overflow = "";
  history.replaceState(null, "", location.pathname);
}
sheet.onclick = e => {
  if (e.target.closest(".fermer")) return fermer();
  const g = e.target.closest("[data-go]"); if (g) ouvrir(g.dataset.go);
};
scrim.onclick = fermer;
addEventListener("keydown", e => { if (e.key === "Escape") fermer(); });
$("#hasard").onclick = () => ouvrir(F[Math.floor(Math.random() * F.length)].slug);

rendre();
if (location.hash.length > 1) ouvrir(decodeURIComponent(location.hash.slice(1)));
</script>
</body>
</html>
