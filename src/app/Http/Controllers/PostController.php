<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Lib\UsePost;
use OpenApi\Attributes as OA;

class PostController extends Controller
{
    #[OA\Get(
        path: '/posts',
        responses: [
            new OA\Response(response: 200, description: 'OK'),
            new OA\Response(response: 401, description: 'Not allowed'),
        ]
    )]
    public function index(): string
    {
        return "index";
    }

    #[OA\Get(
        path: '/posts/create',
        responses: [
            new OA\Response(response: 200, description: 'OK'),
            new OA\Response(response: 401, description: 'Not allowed'),
        ]
    )]
    public function create(): string
    {
        return "create";
    }

    #[OA\Post(
        path: '/posts',
        responses: [
            new OA\Response(response: 200, description: 'OK'),
            new OA\Response(response: 401, description: 'Not allowed'),
        ]
    )]
    public function store(Request $request): string
    {
        return "store" . $request;
    }

    #[OA\Get(
        path: '/posts/{id}',
        responses: [
            new OA\Response(response: 200, description: 'OK'),
            new OA\Response(response: 401, description: 'Not allowed'),
        ]
    )]
    public function show(int $id): string
    {
        return "show" . $id;
    }

    #[OA\Get(
        path: '/posts/{id}/edit',
        responses: [
            new OA\Response(response: 200, description: 'OK'),
            new OA\Response(response: 401, description: 'Not allowed'),
        ]
    )]
    public function edit(int $id): string
    {
        return "edit" . $id;
    }

    #[OA\Put(
        path: '/posts/{id}',
        responses: [
            new OA\Response(response: 200, description: 'OK'),
            new OA\Response(response: 401, description: 'Not allowed'),
        ]
    )]
    public function update(Request $request, int $id): string
    {
        return "update" . $id . $request;
    }

    #[OA\Delete(
        path: '/posts/{id}',
        responses: [
            new OA\Response(response: 200, description: 'OK'),
            new OA\Response(response: 401, description: 'Not allowed'),
        ]
    )]
    public function destroy(int $id): string
    {
        return "destroy" . $id;
    }

    public function count(): UsePost
    {
        $usePost = new UsePost();
        // $count = $usePost;
        return $usePost;
    }
}
