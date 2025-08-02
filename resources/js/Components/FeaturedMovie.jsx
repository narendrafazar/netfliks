import PropTypes from "prop-types";
import { Link } from "@inertiajs/react";

FeaturedMovie.propTypes = {
    slug: PropTypes.string.isRequired,
    name: PropTypes.string.isRequired,
    category: PropTypes.string.isRequired,
    rating: PropTypes.number,
    thumbnail: PropTypes.string.isRequired,
};

export default function FeaturedMovie({
    slug,
    name,
    category,
    rating = 0,
    thumbnail,
}) {
    return (
        <div className="absolute overflow-hidden group mr-[30px]">
            {/* Movie Thumbnail  */}
            <img
                src={thumbnail}
                className="object-cover rounded-[30px] w-[520px] h-[340px]"
                alt=""
            />
            {/* rating  */}
            <div className="rating absolute top-0 left-0">
                <div className="p-[30px] flex items-center gap-1">
                    <img src="/icons/ic_star.svg" alt="" />
                    <span className="text-sm font-medium text-white mt-1">
                        {/* toFixed(1) maksudnya bikin angka desimal dibelakang koma cuma 1 */}
                        {rating.toFixed(1)}/5.0
                    </span>
                </div>
            </div>
            {/* bottom detail  */}
            <div
                className="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black rounded-bl-[28px]
                                rounded-br-[28px] flex justify-between items-center px-5 h-[100px]"
            >
                <div>
                    <div className="font-medium text-[22px] text-white">
                        {name.length > 20 ? name.slice(0, 20) + "..." : name}
                    </div>
                    <p className="mb-0 text-white text-sm font-light">
                        {category.length > 20
                            ? category.slice(0, 20) + "..."
                            : category}
                    </p>
                </div>
                <div className="translate-x-[100px] group-hover:translate-x-0 transition ease-in-out duration-500">
                    <img src="/icons/ic_play.svg" width="50" alt="" />
                </div>
            </div>
            <Link
                href={route("prototype.movie.show", slug)}
                className="inset-0 absolute z-50"
            ></Link>
        </div>
    );
}
