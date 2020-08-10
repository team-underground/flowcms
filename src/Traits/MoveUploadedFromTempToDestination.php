<?php

namespace Flowcms\Flowcms\Traits;

use Illuminate\Support\Facades\Storage;

trait MoveUploadedFromTempToDestination {

	protected static function bootMoveUploadedFromTempToDestination()
    {
        static::creating(function ($model) {

        	// converts all special characters to utf-8
            $html = mb_convert_encoding($model->body, 'HTML-ENTITIES', 'UTF-8');

            // creating new document
	        $doc = new \DOMDocument('1.0', 'UTF-8');

	        //turning off some errors
	        libxml_use_internal_errors(true);
	        
	        // root node is required
	        $doc->loadHTML('<div>' . $html . '</div>');

	        //turning off some errors
	        libxml_clear_errors();
	 
	        $tags = $doc->getElementsByTagName('img');
	 
	        foreach ($tags as $tag) {
	            $oldSrc = $tag->getAttribute('src');

	            if (Storage::disk('public')->exists($oldSrc)) {
	            	$newSrc = '/editor-uploads/' . explode('/', $oldSrc)[2];
	         		
	         		if (! Storage::disk('public')->exists($newSrc)) {
	         			Storage::disk('public')->move($oldSrc, $newSrc);
	         		}
			
					$tag->setAttribute('src', $newSrc);
					$tag->setAttribute('loading', 'lazy');
	            }
	        }    

	        $model->body = substr($doc->saveXML($doc->getElementsByTagName('div')->item(0)), 5, -6);
		});
		
		static::updating(function ($model) {

        	// converts all special characters to utf-8
            $html = mb_convert_encoding($model->body, 'HTML-ENTITIES', 'UTF-8');

            // creating new document
	        $doc = new \DOMDocument('1.0', 'UTF-8');

	        //turning off some errors
	        libxml_use_internal_errors(true);
	        
	        // root node is required
	        $doc->loadHTML('<div>' . $html . '</div>');

	        //turning off some errors
	        libxml_clear_errors();
	 
	        $tags = $doc->getElementsByTagName('img');
	 
	        foreach ($tags as $tag) {
	            $oldSrc = $tag->getAttribute('src');

	            if (Storage::disk('public')->exists($oldSrc)) {
	            	$newSrc = '/editor-uploads/' . explode('/', $oldSrc)[2];
	         		
	         		if (! Storage::disk('public')->exists($newSrc)) {
	         			Storage::disk('public')->move($oldSrc, $newSrc);
	         		}
				
					$tag->setAttribute('src', $newSrc);
					$tag->setAttribute('loading', 'lazy');
	            }
	        }    

	        $model->body = substr($doc->saveXML($doc->getElementsByTagName('div')->item(0)), 5, -6);
        });
    }
 }