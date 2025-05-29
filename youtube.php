<?php
// Exemplo de script PHP com animação 3D estilo bloco Minecraft
$corDoBloco = "#8B4513"; // Cor marrom (estilo madeira)
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Bloco Minecraft Animado</title>
    <style>
        body {
            margin: 0;
            overflow: hidden;
            background-color: #1e1e1e;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
</head>
<body>

<script>
    // Cena, câmera e renderizador
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth/window.innerHeight, 0.1, 1000);
    const renderer = new THREE.WebGLRenderer();
    renderer.setSize(window.innerWidth, window.innerHeight);
    document.body.appendChild(renderer.domElement);

    // Bloco estilo Minecraft (cubo com textura de cor)
    const geometry = new THREE.BoxGeometry(1, 1, 1);
    const material = new THREE.MeshBasicMaterial({ color: "<?php echo $corDoBloco; ?>" });
    const cube = new THREE.Mesh(geometry, material);
    scene.add(cube);

    // Posição da câmera
    camera.position.z = 3;

    // Função de animação
    function animate() {
        requestAnimationFrame(animate);
        cube.rotation.x += 0.01;
        cube.rotation.y += 0.01;
        renderer.render(scene, camera);
    }

    animate();
</script>

</body>
</html>
