<div class="container mt-5">
    <h2>{{$text}}</h2>
    @forelse ($delayedCourses as $course)
        <div class="card mb-4">
            <div class="card-header" onclick="toggleDelayedChapters({{ $loop->index }})" style="cursor: pointer;">
                <h5>{{ $course['course_name'] }}</h5>
                <small>{{ $course['course_description'] }}</small>
            </div>
            <div id="delayed-chapters-{{ $loop->index }}" class="card-body" style="display: none;">
                <h6>Vídeos</h6>
                <ul>
                    @foreach ($course['delayed_chapters'] as $chapter)
                        <li>
                            <strong>Capítulo: {{ $chapter['chapter_name'] }}</strong><br>
                            Descrição do vídeo: {{ $chapter['video_description'] }}<br>
                            Última atualização: {{ $chapter['last_watched'] }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @empty
        <p>Nenhum curso atrasado encontrado.</p>
    @endforelse
</div>