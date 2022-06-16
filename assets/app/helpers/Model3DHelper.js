import * as SceneHelper from "../helpers/Scene3DHelper.js";
import * as THREE from 'three';

export function createTestCube(scene)
{
    // Cube for test position
    const geometry = new THREE.BoxGeometry( 1, 1, 1 );
    const material = new THREE.MeshBasicMaterial( {color: 0x00ff00} );
    const cube = new THREE.Mesh( geometry, material );

    cube.position.x = -16;
    cube.position.y = -2;
    cube.position.z = -2;

    scene.add( cube );
}

export function createPoster(scene, imagePath, position, rotationY, name, callback, size = {width: 1.38, height: 3.8})
{
    var material = new THREE.MeshLambertMaterial({
        map: SceneHelper.loaderPoster.load(imagePath)
    });
    
    // Plane geometry for the image and preserve the image aspect ratio 
    var geometry = new THREE.PlaneGeometry(size.width, size.height * 0.51);
    // Combine image geometry and material 
    var mesh = new THREE.Mesh(geometry, material);
    
    mesh.position.set(position.x, position.y, position.z);
    mesh.rotation.y = rotationY;
    mesh.name = name;
    scene.add(mesh);
    
    mesh.callback = callback;

    return mesh;
}

export function createButton(scene, imagePath, rotationY, position, name, callback)
{
    const geometry = new THREE.PlaneGeometry(1, 1);
    const material = new THREE.MeshBasicMaterial( {color: 0xffff00, side: THREE.DoubleSide} );
    const mesh = new THREE.Mesh( geometry, material );
    mesh.position.set(position.x, position.y, position.z);
    mesh.rotation.y = rotationY;
    mesh.name = name;
    scene.add(mesh);

    mesh.callback = callback;

    return mesh;
}