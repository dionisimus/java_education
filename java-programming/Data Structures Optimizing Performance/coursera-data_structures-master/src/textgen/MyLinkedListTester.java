/**
 *
 */
package textgen;

import org.junit.Before;
import org.junit.Test;

import static org.junit.Assert.assertEquals;
import static org.junit.Assert.fail;

/**
 * @author UC San Diego MOOC team
 */
public class MyLinkedListTester {

    private static final int LONG_LIST_LENGTH = 10;

    MyLinkedList<String> shortList;
    MyLinkedList<Integer> emptyList;
    MyLinkedList<Integer> longerList;
    MyLinkedList<Integer> list1;

    /**
     * @throws java.lang.Exception
     */
    @Before
    public void setUp() throws Exception {
        // Feel free to use these lists, or add your own
        shortList = new MyLinkedList<String>();
        shortList.add("A");
        shortList.add("B");
        emptyList = new MyLinkedList<Integer>();
        longerList = new MyLinkedList<Integer>();
        for (int i = 0; i < LONG_LIST_LENGTH; i++) {
            longerList.add(i);
        }
        list1 = new MyLinkedList<Integer>();
        list1.add(65);
        list1.add(21);
        list1.add(42);

    }

    /**
     * Test if the get method is working correctly.
     */
    /*You should not need to add much to this method.
     * We provide it as an example of a thorough test. */
    @Test
    public void testGet() {
        //test empty list, get should throw an exception
        try {
            emptyList.get(0);
            fail("Check out of bounds");
        } catch (IndexOutOfBoundsException e) {

        }

        // test short list, first contents, then out of bounds
        assertEquals("Check first", "A", shortList.get(0));
        assertEquals("Check second", "B", shortList.get(1));

        try {
            shortList.get(-1);
            fail("Check out of bounds");
        } catch (IndexOutOfBoundsException e) {

        }
        try {
            shortList.get(2);
            fail("Check out of bounds");
        } catch (IndexOutOfBoundsException e) {

        }
        // test longer list contents
        for (int i = 0; i < LONG_LIST_LENGTH; i++) {
            assertEquals("Check " + i + " element", (Integer) i, longerList.get(i));
        }

        // test off the end of the longer array
        try {
            longerList.get(-1);
            fail("Check out of bounds");
        } catch (IndexOutOfBoundsException e) {

        }
        try {
            longerList.get(LONG_LIST_LENGTH);
            fail("Check out of bounds");
        } catch (IndexOutOfBoundsException e) {
        }

    }

    /**
     * Test removing an element from the list.
     * We've included the example from the concept challenge.
     * You will want to add more tests.
     */
    @Test
    public void testRemove() {
        int a = list1.remove(0);
        assertEquals("Remove: check a is correct ", 65, a);
        assertEquals("Remove: check element 0 is correct ", (Integer) 21, list1.get(0));
        assertEquals("Remove: check size is correct ", 2, list1.size());

        a = list1.remove(1);
        assertEquals("Remove: check a is correct ", 42, a);
        assertEquals("Remove: check element 0 is correct ", (Integer) 21, list1.get(0));
        assertEquals("Remove: check size is correct ", 1, list1.size());
    }

    /**
     * Test adding an element into the end of the list, specifically
     * public boolean add(E element)
     */
    @Test
    public void testAddEnd() {
        list1.add(123456);
        assertEquals(123456, list1.get(list1.size - 1).intValue());
    }

    /**
     * Test the size of the list
     */
    @Test
    public void testSize() {
        assertEquals(3, list1.size);
        list1.add(123456);
        assertEquals(4, list1.size);
    }

    /**
     * Test adding an element into the list at a specified index,
     * specifically:
     * public void add(int index, E element)
     */
    @Test
    public void testAddAtIndex() {
        assertEquals(3, list1.size);
        Integer expectOnPosition2 = list1.get(2);
        list1.add(2, 123456);
        assertEquals(123456, list1.get(2).intValue());
        assertEquals(4, list1.size);
        assertEquals(expectOnPosition2, list1.get(3));
    }

    /**
     * Test setting an element in the list
     */
    @Test
    public void testSet() {
        assertEquals(3, list1.size);
        list1.set(2, 123456);
        assertEquals(123456, list1.get(2).intValue());
        assertEquals(3, list1.size);
    }

    @Test
    public void testSetTooLowIndex() {
        try {
            list1.set(-1, 1);
            fail("Check out of bounds");
        } catch (IndexOutOfBoundsException ioobe) {
        }
    }

    @Test
    public void testSetTooHighIndex() {
        try {
            list1.set(3, 1);
            fail("Check out of bounds");
        } catch (IndexOutOfBoundsException ioobe) {
        }
    }

    @Test
    public void testRemoveTooLowIndex() {
        try {
            list1.remove(-1);
            fail("Check out of bounds");
        } catch (IndexOutOfBoundsException ioobe) {
        }
    }

    @Test
    public void testRemoveTooHighIndex() {
        try {
            list1.remove(3);
            fail("Check out of bounds");
        } catch (IndexOutOfBoundsException ioobe) {
        }
    }

    @Test
    public void testAddTooLowIndex() {
        try {
            list1.add(-1, 123);
            fail("Check out of bounds");
        } catch (IndexOutOfBoundsException ioobe) {
        }
    }

    @Test
    public void testAddTooHighIndex() {
        try {
            list1.add(4, 123);
            fail("Check out of bounds");
        } catch (IndexOutOfBoundsException ioobe) {
        }
    }

    @Test
    public void testSetNullElement() {
        try {
            list1.set(1, null);
            fail("Check nullcheck");
        } catch (NullPointerException npe) {
        }
    }

    @Test
    public void testAddNullElement() {
        try {
            list1.add(null);
            fail("Check nullcheck");
        } catch (NullPointerException npe) {
        }
    }
}
