import * as THREE from 'three';
import { gsap } from "gsap";

const raycaster = new THREE.Raycaster();
var mouse = new THREE.Vector2();

let renderer;
let camera;
let scene;
let controls;

export function onDocumentMouseDown( event ) {
    mouse.x = ( event.clientX / renderer.domElement.clientWidth ) * 2 - 1;
    mouse.y = - ( event.clientY / renderer.domElement.clientHeight ) * 2 + 1;
    raycaster.setFromCamera( mouse, camera );
    var intersects = raycaster.intersectObjects( scene.children );
    
    if (intersects.length > 0) {
        if (intersects[0].object.callback) {
            intersects[0].object.callback();
        }
    }
}

function cameraMove(x, y, z, target){
    gsap.to(camera.position, x);
    gsap.to(camera.position, y);
    gsap.to(camera.position, z);
    controls.target.set(target.x, target.y, target.z);
}

export function cameraMoveReturn() {
    cameraMove({x: 1.2, duration: 10}, {y: -1.5, duration: 2}, {z: -1.8, duration: 10}, {x: -12, y: -2, z: -2});
}

export function cameraMoveCine() {
    cameraMove({x: 0, duration: 10}, {y: -1.5, duration: 2}, {z: -7.85, duration: 10}, {x: 0.71, y: -3.2, z: -29.02});
}

export function cameraMoveContact() {
    cameraMove({x: 5.4, duration: 10}, {y: -2, duration: 2}, {z: -3.2, duration: 10}, {x: 18.5, y: -2, z: -3.2});
}

export function setupNavigation(_scene, _renderer, _camera, _controls)
{
    scene = _scene;
    renderer = _renderer;
    camera = _camera;
    controls = _controls;
}