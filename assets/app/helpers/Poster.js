import * as THREE from 'three';
import { gsap } from "gsap";
import * as dat from 'lil-gui';

const gui = new dat.GUI({
        width: 400
    });


export function filmAffiche(){
    // Black screen picture
    var loaderTab = new THREE.TextureLoader();
    var materialTab = new THREE.MeshLambertMaterial({
    map: loaderTab.load('https://ak.picdn.net/shutterstock/videos/30298276/thumb/12.jpg')
    });
    // Plane geometry for the image and preserve the image aspect ratio 
    var geometryTab = new THREE.PlaneGeometry(2.62, 3.62*0.51);
    // Combine image geometry and material 
    var meshTab = new THREE.Mesh(geometryTab, materialTab);

    // meshTab.position.set(-5.6,-1.8,2.8)
    meshTab.position.x(-5.6)
    meshTab.position.y(-1.8)
    meshTab.position.z(-2.8)

    const poster1 = gui.addFolder('Poster')
    poster1.add(meshTab.position, 'x', 0, Math.PI * 2)
    poster1.add(meshTab.position, 'y', 0, Math.PI * 2)
    poster1.add(meshTab.position, 'z', 0, Math.PI * 2)
    poster1.add(meshTab.rotation, 'x', 0, Math.PI * 2)
    poster1.add(meshTab.rotation, 'y', 0, Math.PI * 2)
    poster1.add(meshTab.rotation, 'z', 0, Math.PI * 2)
    poster1.open()

    scene.add(meshTab)
}

export function salleInfos(){
    const geometryPlane = new THREE.PlaneGeometry( 1, 1 );
    const materialPlane = new THREE.MeshBasicMaterial( {color: 0xffff00, side: THREE.DoubleSide} );
    const plane = new THREE.Mesh( geometryPlane, materialPlane );
    plane.position.set(0, -2.4, 26.5)
    plane.name = "salleInfos";
    scene.add( plane );
}

export function salleTalent(){
    const geometryPlane = new THREE.PlaneGeometry( 1, 1 );
    const materialPlane = new THREE.MeshBasicMaterial( {color: 0xffff00, side: THREE.DoubleSide} );
    const plane = new THREE.Mesh( geometryPlane, materialPlane );
    plane.position.set(0, -2.4, 26.5)
    plane.name = "salleTalent";
    scene.add( plane );
}

export function salleActus(){
    const geometryPlane = new THREE.PlaneGeometry( 1, 1 );
    const materialPlane = new THREE.MeshBasicMaterial( {color: 0xffff00, side: THREE.DoubleSide} );
    const plane = new THREE.Mesh( geometryPlane, materialPlane );
    plane.position.set(0, -2.4, 26.5)
    plane.name = "salleActus";
    scene.add( plane );
}

export function salleContact(){
    const geometryPlane = new THREE.PlaneGeometry( 1, 1 );
    const materialPlane = new THREE.MeshBasicMaterial( {color: 0xffff00, side: THREE.DoubleSide} );
    const plane = new THREE.Mesh( geometryPlane, materialPlane );
    plane.position.set(0, -2.4, 26.5)
    plane.name = "salleContact";
    scene.add( plane );
}