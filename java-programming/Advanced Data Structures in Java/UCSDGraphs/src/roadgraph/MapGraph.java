/**
 * @author UCSD MOOC development team and YOU
 * 
 * A class which reprsents a graph of geographic locations
 * Nodes in the graph are intersections between 
 *
 */
package roadgraph;



import java.util.ArrayList;
import java.util.Comparator;
import java.util.HashMap;
import java.util.HashSet;
import java.util.LinkedList;
import java.util.List;
import java.util.Map;
import java.util.PriorityQueue;
import java.util.Queue;
import java.util.Set;
import java.util.function.Consumer;

import geography.GeographicPoint;
import util.GraphLoader;

/**
 * @author UCSD MOOC development team and YOU
 * 
 * A class which represents a graph of geographic locations
 * Nodes in the graph are intersections between 
 *
 */
public class MapGraph {
	//TODO: Add your member variables here in WEEK 3
	
//	private List <GeographicPoint> vertixList = new ArrayList <GeographicPoint>();
//	private Map <GeographicPoint, ArrayList <GeographicPoint>> adjList = new HashMap <GeographicPoint, ArrayList <GeographicPoint>>();
	
	HashMap <GeographicPoint, MapNodes> nodes = new HashMap <GeographicPoint, MapNodes>();
	
	/** 
	 * Create a new empty MapGraph 
	 */
	public MapGraph() {
		
	}
	
	/**
	 * Get the number of vertices (road intersections) in the graph
	 * @return The number of vertices in the graph.
	 */
	public int getNumVertices()
	{
		//TODO: Implement this method in WEEK 3
		
		return nodes.size();
	}
	

	
	/**
	 * Return the intersections, which are the vertices in this graph.
	 * @return The vertices in this graph as GeographicPoints
	 */
	public Set<GeographicPoint> getVertices()
	{
		//TODO: Implement this method in WEEK 3
		
		return nodes.keySet();
	}
	
	/**
	 * Get the number of road segments in the graph
	 * @return The number of edges in the graph.
	 */
	public int getNumEdges()
	{
		
		int edgesTotal = 0;
		for (GeographicPoint n : getVertices()) {
			MapNodes value = nodes.get(n);
			List <MapEdges> edgeTemp = value.edges;
			edgesTotal += edgeTemp.size();
		}
		
		return edgesTotal;
	}

	
	
	/** Add a node corresponding to an intersection at a Geographic Point
	 * If the location is already in the graph or null, this method does 
	 * not change the graph.
	 * @param location  The location of the intersection
	 * @return true if a node was added, false if it was not (the node
	 * was already in the graph, or the parameter is null).
	 */
	public boolean addVertex(GeographicPoint location)
	{
		// TODO: Implement this method in WEEK 3
		if (nodes.containsKey(location) || location == null) {
			return false;
		}
		nodes.put(location, new MapNodes(location));
		return true;
	}
	
	/**
	 * Adds a directed edge to the graph from pt1 to pt2.  
	 * Precondition: Both GeographicPoints have already been added to the graph
	 * @param from The starting point of the edge
	 * @param to The ending point of the edge
	 * @param roadName The name of the road
	 * @param roadType The type of the road
	 * @param length The length of the road, in km
	 * @throws IllegalArgumentException If the points have not already been
	 *   added as nodes to the graph, if any of the arguments is null,
	 *   or if the length is less than 0.
	 */
	public void addEdge(GeographicPoint from, GeographicPoint to, String roadName,
			String roadType, double length) throws IllegalArgumentException {

		
		//TODO: Implement this method in WEEK 3
		if (from == null || to == null|| from.distance(to) < 0 || !nodes.containsKey(from) || !nodes.containsKey(to)) {
			throw new IllegalArgumentException ("oops...something went wrong");
		}
		
		for (MapEdges n: nodes.get(from).getEdges()){
			if (n.getStart() == from && n.getEnd() == to) {
				throw new IllegalArgumentException ("Edge exists");
			}
		}
		
		MapEdges temp = new MapEdges();
		temp.setStart(from);
		temp.setEnd(to);
		temp.setRoadType(roadType);
		temp.setRoadName(roadName);
		temp.setDist(length);
		
		nodes.get(from).setEdges(temp);
	}
	

	/** Find the path from start to goal using breadth first search
	 * 
	 * @param start The starting location
	 * @param goal The goal location
	 * @return The list of intersections that form the shortest (unweighted)
	 *   path from start to goal (including both start and goal).
	 */
	public List<GeographicPoint> bfs(GeographicPoint start, GeographicPoint goal) {
		// Dummy variable for calling the search algorithms
        Consumer<GeographicPoint> temp = (x) -> {};
        return bfs(start, goal, temp);
	}
	
	/** Find the path from start to goal using breadth first search
	 * 
	 * @param start The starting location
	 * @param goal The goal location
	 * @param nodeSearched A hook for visualization.  See assignment instructions for how to use it.
	 * @return The list of intersections that form the shortest (unweighted)
	 *   path from start to goal (including both start and goal).
	 */
	public List<GeographicPoint> bfs(GeographicPoint start, 
			 					     GeographicPoint goal, Consumer<GeographicPoint> nodeSearched)
	{
		// TODO: Implement this method in WEEK 3
		
		Queue<GeographicPoint> queue = new LinkedList<GeographicPoint>();
		List <GeographicPoint> visitedSet = new ArrayList <GeographicPoint>();
		
		
		 
		GeographicPoint curr = start;
		queue.add(curr);
		visitedSet.add(curr);
		

		

		while (queue.peek() != null) {
			nodeSearched.accept(queue.peek());
			if (queue.peek().equals(goal)) {
				return visitedSet;
			}

			if (nodes.get(queue.peek()).edges.size() >0 ) {
				for (MapEdges n : nodes.get(queue.peek()).edges) {
					if (!visitedSet.contains(n.end)) {
						visitedSet.add(n.end);
						queue.add(n.end);	
					}
				}
			}
			queue.remove();
		}
		
		// Hook for visualization.  See writeup.
		//nodeSearched.accept(next.getLocation());

		return null;
	}
	

	/** Find the path from start to goal using Dijkstra's algorithm
	 * 
	 * @param start The starting location
	 * @param goal The goal location
	 * @return The list of intersections that form the shortest path from 
	 *   start to goal (including both start and goal).
	 */
	public List<GeographicPoint> dijkstra(GeographicPoint start, GeographicPoint goal) {
		// Dummy variable for calling the search algorithms
		// You do not need to change this method.
        Consumer<GeographicPoint> temp = (x) -> {};
        return dijkstra(start, goal, temp);
	}
	
	/** Find the path from start to goal using Dijkstra's algorithm
	 * 
	 * @param start The starting location
	 * @param goal The goal location
	 * @param nodeSearched A hook for visualization.  See assignment instructions for how to use it.
	 * @return The list of intersections that form the shortest path from 
	 *   start to goal (including both start and goal).
	 */
	public List<GeographicPoint> dijkstra(GeographicPoint start, 
										  GeographicPoint goal, Consumer<GeographicPoint> nodeSearched)
//	{
//		// TODO: Implement this method in WEEK 4
//
//		// Hook for visualization.  See writeup.
//		//nodeSearched.accept(next.getLocation());

	{
		PriorityQueue <MapNodes> pq = new PriorityQueue <MapNodes>();
		Set <MapNodes> visited = new HashSet <MapNodes>();
		HashMap <MapNodes,MapNodes> parentMap = new HashMap <MapNodes,MapNodes> ();
		
		MapNodes startNode = nodes.get(start);
		startNode.setDistance(0);
		pq.add(startNode);
	
		while (!pq.isEmpty()) {
			MapNodes curr = pq.poll();
			if (!visited.contains(curr)) {
			visited.add(curr);
			if (curr.getLocation().equals(goal)) {

				return createPath(parentMap, nodes.get(goal), nodes.get(start));
			}
			
			for (MapEdges neighb : curr.getEdges()) {
				MapNodes next = nodes.get(neighb.getEnd());
				if (!visited.contains(next)) {
					double newDist = curr.getCurrDistance() + neighb.getDistance();
					if (next.getCurrDistance() > newDist) {
						next.setDistance(newDist);
						parentMap.put(next,curr);
						pq.add(next);
					}
				}
				
			}
		}
	}
		return null;

}
	
	
	private List<GeographicPoint> createPath(HashMap<MapNodes,MapNodes> map, MapNodes goal, MapNodes start){
		List<GeographicPoint> route = new LinkedList<>();
		MapNodes current = goal;
		
		while(!current.equals(start)){
			
			((LinkedList<GeographicPoint>) route).addFirst(current.getLocation());
			//route.addFirst(map.get(current).getLocation());
			System.out.println(current.getLocation());
			current = map.get(current);
			
		}
		((LinkedList<GeographicPoint>) route).addFirst(start.getLocation());
		return route;
	}
	
	
	/** Find the path from start to goal using A-Star search
	 * 
	 * @param start The starting location
	 * @param goal The goal location
	 * @return The list of intersections that form the shortest path from 
	 *   start to goal (including both start and goal).
	 */
	public List<GeographicPoint> aStarSearch(GeographicPoint start, GeographicPoint goal) {
		// Dummy variable for calling the search algorithms
        Consumer<GeographicPoint> temp = (x) -> {};
        return aStarSearch(start, goal, temp);
	}
	
	/** Find the path from start to goal using A-Star search
	 * 
	 * @param start The starting location
	 * @param goal The goal location
	 * @param nodeSearched A hook for visualization.  See assignment instructions for how to use it.
	 * @return The list of intersections that form the shortest path from 
	 *   start to goal (including both start and goal).
	 */
	public List<GeographicPoint> aStarSearch(GeographicPoint start, 
											 GeographicPoint goal, Consumer<GeographicPoint> nodeSearched)
	{
		// TODO: Implement this method in WEEK 4
		
		// Hook for visualization.  See writeup.
		//nodeSearched.accept(next.getLocation());
		
		return null;
	}

	
	
	public static void main(String[] args)
	{
		System.out.print("Making a new map...");
		MapGraph firstMap = new MapGraph();
		System.out.print("DONE. \nLoading the map...");
		GraphLoader.loadRoadMap("data/testdata/simpletest.map", firstMap);
		System.out.println("DONE.");
		
		
		
		GeographicPoint testStart = new GeographicPoint(1.0, 1.0);
		GeographicPoint testEnd = new GeographicPoint(8.0, -1.0);
		
//		for (GeographicPoint n : firstMap.dijkstra(testStart,testEnd)) {
//			System.out.println(n);
//		}
		
		
		
		System.out.println(firstMap.dijkstra(testStart,testEnd));
//		firstMap.dijkstra(testStart,testEnd);
		
//		System.out.println();
		//System.out.println();
		
		//addEdge(GeographicPoint from, GeographicPoint to, String roadName, String roadType, double length) throws IllegalArgumentException
		
		
//		List<GeographicPoint> bfs(GeographicPoint start, GeographicPoint goal, Consumer<GeographicPoint> nodeSearched)
		
		// You can use this method for testing.  
		
		
		/* Here are some test cases you should try before you attempt 
		 * the Week 3 End of Week Quiz, EVEN IF you score 100% on the 
		 * programming assignment.
		 */
		/*
		MapGraph simpleTestMap = new MapGraph();
		GraphLoader.loadRoadMap("data/testdata/simpletest.map", simpleTestMap);
		
		GeographicPoint testStart = new GeographicPoint(1.0, 1.0);
		GeographicPoint testEnd = new GeographicPoint(8.0, -1.0);
		
		System.out.println("Test 1 using simpletest: Dijkstra should be 9 and AStar should be 5");
		List<GeographicPoint> testroute = simpleTestMap.dijkstra(testStart,testEnd);
		List<GeographicPoint> testroute2 = simpleTestMap.aStarSearch(testStart,testEnd);
		
		
		MapGraph testMap = new MapGraph();
		GraphLoader.loadRoadMap("data/maps/utc.map", testMap);
		
		// A very simple test using real data
		testStart = new GeographicPoint(32.869423, -117.220917);
		testEnd = new GeographicPoint(32.869255, -117.216927);
		System.out.println("Test 2 using utc: Dijkstra should be 13 and AStar should be 5");
		testroute = testMap.dijkstra(testStart,testEnd);
		testroute2 = testMap.aStarSearch(testStart,testEnd);
		
		
		// A slightly more complex test using real data
		testStart = new GeographicPoint(32.8674388, -117.2190213);
		testEnd = new GeographicPoint(32.8697828, -117.2244506);
		System.out.println("Test 3 using utc: Dijkstra should be 37 and AStar should be 10");
		testroute = testMap.dijkstra(testStart,testEnd);
		testroute2 = testMap.aStarSearch(testStart,testEnd);
		*/
		
		
		/* Use this code in Week 3 End of Week Quiz */
		/*MapGraph theMap = new MapGraph();
		System.out.print("DONE. \nLoading the map...");
		GraphLoader.loadRoadMap("data/maps/utc.map", theMap);
		System.out.println("DONE.");

		GeographicPoint start = new GeographicPoint(32.8648772, -117.2254046);
		GeographicPoint end = new GeographicPoint(32.8660691, -117.217393);
		
		
		List<GeographicPoint> route = theMap.dijkstra(start,end);
		List<GeographicPoint> route2 = theMap.aStarSearch(start,end);

		*/
		

	}

}

class MapNodes implements Comparable<MapNodes>{
	GeographicPoint location = new GeographicPoint(0,0);
	List <MapEdges> edges = new ArrayList <MapEdges>();
	double currDistance = Double.POSITIVE_INFINITY;
	
	public MapNodes () {
	}
	
	public MapNodes (GeographicPoint val) {
		this.location = val;
	}
	
	public GeographicPoint getLocation() {
		return location;
	}
	public void setLocation(GeographicPoint val) {
		location = val;
	}
	public List <MapEdges> getEdges() {
		return edges;
	}
	public void setEdges(MapEdges val) {
		edges.add(val);
	}
	
	public void currDistance(double val) {
		currDistance = val;
	}
	
	public double getCurrDistance() {
		return currDistance;
	}
	
	public void setDistance(double val) {
		currDistance = val;
	}
	
	@Override
	public int compareTo(MapNodes other) {
	    if(this.getCurrDistance() > other.getCurrDistance()) {
	        return 1;
	    } 
	    if (this.getCurrDistance() < other.getCurrDistance()) {
	        return -1;
	    } else {
	        return 0;
	    }
	}
	
}


class MapEdges {
	GeographicPoint start;
	GeographicPoint end;
	String roadName;
	String roadType;
	double distance;

	public GeographicPoint getStart() {
		return start;
	}
	
	public GeographicPoint getEnd() {
		return end;
	}
	
	public double getDistance() {
		return start.distance(end);
	}
	
	public void setStart(GeographicPoint val) {
		start = val;

	}
	public void setEnd(GeographicPoint val) {
		end = val;

	}
	public void setRoadName(String val) {
		roadName = val;

	}
	public void setRoadType(String val) {
		roadType = val;

	}
	public void setDist(double val) {
		distance = val;

	}
}