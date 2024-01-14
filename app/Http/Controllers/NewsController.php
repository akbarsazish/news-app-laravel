<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;


class NewsController extends Controller
{

    public function createNews(Request $request)
    {
        $batch = $request->input('articles', []);

        try {
            // Begin a database transaction
            \DB::beginTransaction();

            // Process and store the batch in the database
            // You may want to validate and sanitize the data before storing it

            foreach ($batch as $article) {
                News::create([
                    'author' => $article['author'],
                    'title' => $article['title'],
                    'content' => $article['content'],
                    'description' => $article['description'],
                    'url' => $article['url'],
                    'url_to_image' => $article['urlToImage'],

                ]);
            }

            // Commit the transaction if all inserts were successful
            \DB::commit();

            return response()->json(['message' => 'Batch created successfully']);
        } catch (\Exception $e) {
            // Rollback the transaction if any exception occurred
            \DB::rollback();

            // Log the exception for debugging
            \Log::error('Error creating batch: ' . $e->getMessage());

            // Send an error response
            return response()->json(['error' => 'Error creating batch'], 500);
        }
    }
}
