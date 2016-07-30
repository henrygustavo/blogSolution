<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services;

/**
 *
 * @author GUSTAVO
 */
interface FileManagerInterface {
    public function  getFolders($folderId);
    public function getFiles($parentFolderId);
}
